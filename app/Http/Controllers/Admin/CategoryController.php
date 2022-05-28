<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $categories = Category::orderBy('id', 'desc')->get();
            return view('pages.admin.category.index', compact('categories'));
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
        try{

            return view('pages.admin.category.add');
        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $category = new Category();
            $category->title = $request->title;
            $category->status = $request->status;
            $category->desc = $request->desc;
            if($request->logo){
                $time = time();
                $destinationpath = 'category';
                $file = $request->logo;
                $filename = $time . $file->getClientOriginalName();
                $path = $file->storeAs($destinationpath, $filename);
                $category->logo = $path;
            }

            $category->save();

            Toastr::success("Successfully Stored");
            return redirect()->back();


        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
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
        $category = Category::where('id', $id)->first();
        return view('pages.admin.category.edit', compact('category'));
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
        $category = Category::where('id', $id)->first();
        if($category){
            $category->title = $request->title;
            $category->status = $request->status;
            $category->desc = $request->desc;
            if($request->logo){
                if($category->logo){
                    Storage::delete($category->logo);
                }
                $time = time();
                $destinationpath = 'category';
                $file = $request->logo;
                $filename = $time . $file->getClientOriginalName();

                $path = $file->storeAs($destinationpath, $filename);
                $category->logo = $path;

            }
            $category->update();

            Toastr::success('Successfully Updated');
            return redirect()->back();

        }
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

            $category = Category::where('id', $id)->first();
            if($category->logo && Storage::exists($category->logo)){
                Storage::delete($category->logo);
            }
            $category->delete();

            Toastr::success('Successfully Deleted');
            return redirect()->back();

        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }
}
