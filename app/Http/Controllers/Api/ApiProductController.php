<?php

namespace App\Http\Controllers\Api;

use App\GlobalServices\ResponseService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ApiProductController extends Controller
{
    protected $response, $category;


    public function __construct(ResponseService $response)
    {
        $this->response = $response;
    }

    public function allproduct(){
        try{
            $allproducts =Product::all();
            return $this->response->responseSuccess(ProductResource::collection($allproducts)," Get All Products");
        }catch( \Exception $e){
            return $this->response->responseError($e->getMessage());
        }

    }

    public function product($id){
        try{
            $product = Product::where('id', $id)->first();
            return $this->response->responseSuccess(new ProductResource($product)," Get Product By ID");
        }catch( \Exception $e){
            return $this->response->responseError($e->getMessage());
        }

    }

    public function productBySlug($slug){
        try{
            $product =  Product::where('slug', $slug)->first();
            return $this->response->responseSuccess(new ProductResource($product), " Get Products By  Slug");
        }catch( \Exception $e){
            return $this->response->responseError($e->getMessage());
        }

    }
}
