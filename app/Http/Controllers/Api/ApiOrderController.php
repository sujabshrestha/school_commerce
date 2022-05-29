<?php

namespace App\Http\Controllers\Api;

use App\GlobalServices\ResponseService;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\OrderDetail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiOrderController extends Controller
{


    protected $response;
    public function __construct(ResponseService $response)
    {
        $this->response = $response;
    }




    public function orderSubmit(Request $request){
        try{
            $order = new Order();
            $order->order_code = rand(0, 99999);
            $order->user_id = Auth::id() ?? 2;
            if($request->products){
                $collection = collect($request->products);
                $order->total_amount = $collection->sum('price');
            }
            $order->order_status = 'pending';
            $order->additional_note = $request->additionalnote;
            $ordersaved = $order->save();
            if($ordersaved){
                foreach($request->products as $product){
                    $orderdetail = new OrderDetail();
                    $orderdetail->order_id = $order->id;
                    $orderdetail->product_id = $product['product_id'];
                    $orderdetail->price = $product['price'];
                    $orderdetail->quantity = $product['quantity'];
                    $orderdetail->save();
                }
                return $this->response->responseSuccessMsg("Success");

            }
            return $this->response->responseError("Something went wrong");




        }catch(\Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }



    public function getOrderByID($id){
        try{
            $orders = Order::where('id', $id)->with(['user', 'orderdetails.product'])->first();
            return $this->response->responseSuccess([
                'singleOrder' => new OrderResource($orders),
            ],
            " Get Order By Id");
        }catch(\Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }

    public function getOrderByCode($code){
        try{
            $orders = Order::where('order_code', $code)->with(['user', 'orderdetails.product'])->first();
            return $this->response->responseSuccess([
                'singleOrder' => new OrderResource($orders),
            ],
            " Get All Order By Code ");
        }catch(\Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }

    public function getOrderByUser($id){
        try{
            $orders = $this->order->getOrderByUser($id);

            return $this->response->responseSuccess([
                'singleOrder' => new OrderResource($orders),
            ],
            " Get All Order By Code ");
        }catch(\Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }
}
