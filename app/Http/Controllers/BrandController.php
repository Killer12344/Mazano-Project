<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::latest('id')->with('user')->get();
        $brands = Brand::latest('id')->with('user')->get();
        $products = Product::latest('id')->with('user','product');
        return view('brand.index',compact('categories','brands','products'));
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
            'name'=>'required|unique:brands,name|min:1'
        ]);

        $brands = new Brand();
        $brands->name = $request->name;
        $brands->user_id = Auth::id();
        $brands->slug = Str::slug($request->name).'-'.uniqid();

        $brands->save();

        return redirect()->route('brand.index')->with('message',['icon'=>'success','title'=>'Success']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
        return view('brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name'=>'required|unique:brands,name|min:1'
        ]);


        $brand->name = $request->name;
        $brand->user_id = Auth::id();
        $brand->slug = Str::slug($request->title).'-'.uniqid();
        $brand->update();

        return redirect()->route('category.index')->with('message',['icon'=>'success','title'=>'Update is Success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
        $brand->delete();
        return redirect()->back();
    }
}
