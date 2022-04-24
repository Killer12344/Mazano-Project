<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */


    public function index()
    {
        //
        $categories = Category::latest('id')->with('user')->get();
        $brands = Brand::latest('id')->with('user')->get();
        $products = Product::latest('id')->with('user','product');
        return view('category.index',compact('categories','brands','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'title'=>'required|min:2|unique:categories,title'
        ]);

        $category = new Category();

        $category->title = $request->title;
        $category->user_id = Auth::id();
        $category->slug = Str::slug($request->title).'-'.uniqid();
        $category->save();
        return redirect()->route('category.index')->with('message',['icon'=>'success','title'=>'Success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'title'=>'required|min:2|unique:categories,title'
        ]);

        $category->title = $request->title;
        $category->user_id = Auth::id();
        if ($category->title!=$request->title){
            $category->slug = Str::slug($request->title).'-'.uniqid();
        }
        $category->update();
        return redirect()->route('category.index')->with('message',['icon'=>'success','title'=>'Update is Success']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
