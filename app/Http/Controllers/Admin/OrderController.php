<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\GlobalServices\ResponseService;
use Brian2694\Toastr\Facades\Toastr;

class OrderController extends Controller
{
    protected $response;
    public function __construct(ResponseService $response)
    {
        $this->response = $response;
    }

    public function allorders()
    {
        try {
            $orders = Order::latest()->get();
            return view('pages.admin.orders.index', compact('orders'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function viewOrder(Request $request,$id){
        try{
            $order = Order::where('id', $id)->with(['user', 'orderdetails.product'])->first();
            if($request->ajax()){
                $data = [
                    'view' => view('pages.admin.orders.appendTable', compact('order'))->render()
                ];
                return $this->response->responseSuccess($data, 'success', 200);
            }

        }catch(\Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }

    public function changeStatus(Request $request, $id){
        try{
            $order = Order::where('id', $id)->first();
            if($order){
                $order->order_status = $request->status;
                $order->update();

                return $this->response->responseSuccessMsg("success");
            }

            return $this->response->responseError("Order Not found");

        }catch(\Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }

}
