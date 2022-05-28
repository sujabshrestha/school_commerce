<?php

namespace App\Http\Controllers\Api;

use App\GlobalServices\ResponseService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class ApiCategoryController extends Controller
{
    public $response;
    public function __construct(ResponseService $response)
    {
        $this->response = $response;

    }

    public function allcategories(){
        try{
            $allcategory = Category::all();
            // return $this->response->responseSuccess(json_encode($allcategory), "success", 200);
            return $this->response->responseSuccess(
               [
                   'categories' =>  CategoryResource::collection($allcategory),
               ]," Get All Categories"
            );
        }catch( \Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }

    public function category($id){
        try{
            $category = Category::where('id', $id)->first();
            return $this->response->responseSuccess(new CategoryResource($category), 'Get Category by Category ID');
        }catch(\Exception $e){
            return $this->response->responseError($e->getMessage());
        }

    }

    public function CategoryBySlug($slug){
        try{
            $category = Category::where('slug', $slug)->first();
            return $this->response->responseSuccess(new CategoryResource($category), " Get Category By Category Slug");
        }catch(\Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }
}
