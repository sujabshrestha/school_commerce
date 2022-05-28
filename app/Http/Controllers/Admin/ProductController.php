<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $products = Product::with('category')->latest()->get();
            return view('pages.admin.product.index', compact('products'));

        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.admin.product.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = new Product();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->desc = $request->desc;
        $product->short_desc = $request->short_desc;
        if($request->feature_img){
            $time = time();
            $destinationpath = 'product';
            $file = $request->feature_img;
            $filename = $time . $file->getClientOriginalName();
            $path = $file->storeAs($destinationpath, $filename);
            $product->feature_img = $path;
        }
        $product->save();

        Toastr::success("Successfully Submitted");
        return redirect()->route('admin.product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $product = Product::where('id',$id)->first();
            $categories = Category::all();
            return view('pages.admin.product.edit', compact('product', 'categories'));

        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        if($product){
            $product->title = $request->title;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->desc = $request->desc;
            $product->short_desc = $request->short_desc;
            if($request->feature_img){
                if($product->feature_img && Storage::exists($product->feature_img)){
                    Storage::delete($product->feature_img);
                }
                $time = time();
                $destinationpath = 'product';
                $file = $request->feature_img;
                $filename = $time . $file->getClientOriginalName();

                $path = $file->storeAs($destinationpath, $filename);
                $product->feature_img = $path;

            }

            $product->update();

            Toastr::success("Successfully Update");
            return redirect()->back();
        }

        Toastr::error("Product Not found");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $product = Product::where('id', $id)->first();
            if($product->feature_img && Storage::exists($product->feature_img)){
                Storage::delete($product->feature_img);
            }
            $product->delete();

            Toastr::success('Successfully Deleted');
            return redirect()->back();

        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }
}
