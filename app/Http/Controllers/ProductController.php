<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Photo;
use App\Product;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\True_;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::when(isset(request()->search),function ($query){
             $search = \request()->search;
             return $query->where('title','like',"%$search%");
        })->with('user','category','brand')->latest('id')->paginate(5);

        return view('product.index',compact('products'))->with('detail');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        return $request;

        $request->validate([
            'title'=>'required|max:255|min:10',
            'description'=>'required|min:20|',
            'price'=>'required|integer|max:100000',
            'category'=>'required',
            'brand'=>'required',
            'photo' => 'required|mimes:jpg,jpeg,png|max:2500'
        ]);

        $cat = Category::all();
        $brand = Brand::all();

        $photo = $request->file('photo');
        $src = 'public/product/';
        $fileName = uniqid()."photo.".$photo->getClientOriginalExtension();
        $photo->storeAs($src,$fileName);

        $product = new Product();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->user_id = Auth::id();
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->product_slug = Str::slug($request->title).'-'.uniqid();
        $product->category_slug = $cat->find($request->category)->slug;
        $product->brand_slug = $brand->find($request->brand)->slug;
        $product->photo_link = $fileName;

        if ($request->hasFile('photos')){
            $fileArray = [];
            foreach ($request->file('photos') as $file) {
                $fileName = uniqid()."photo.".$file->getClientOriginalExtension();
                $src = '/public/products';
                array_push($fileArray,$fileName);
                $file->storeAs($src,$fileName);
            }
        }

        $product->save();

        if ($request->hasFile('photos')){
            foreach ($fileArray as $f){
                $photo = new Photo();
                $photo->product_id = $product->id;
                $photo->photos = $f;
                $photo->save();
            }
        }


        return redirect()->route('product.create')->with('message',['icon'=>'success','title'=>'New Product is Add']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return view('product.detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit',compact('product'))->with(['photo']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            'title'=>'required|max:255|min:10',
            'description'=>'required|min:20|',
            'price'=>'required|integer|max:100000',
            'category'=>'required',
            'brand'=>'required',
            'photo' => 'mimes:jpg,jpeg,png|max:2500'
        ]);

        $cat = Category::all();
        $brand = Brand::all();

        if ($request->file('photo')){
            $photo = $request->file('photo');
            $src = 'public/product/';
            $fileName = uniqid()."photo.".$photo->getClientOriginalExtension();
            $photo->storeAs($src,$fileName);
        }

        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->user_id = Auth::id();
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        if ($product->title != $request->title){
            $product->product_slug = Str::slug($request->title).'-'.uniqid();
            $product->category_slug = Str::slug($cat->find($request->category)->title).'-'.uniqid();
            $product->brand_slug = Str::slug($brand->find($request->brand)->name).'-'.uniqid();
        }

        if ($request->file('photo')){
            $product->photo_link = $fileName;
        }

        $product->update();

        return redirect()->route('product.create')->with('message',['icon'=>'success','title'=>'Product is Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return redirect()->back()->with('message',['icon'=>'success','title'=>'Product is Remove Now!']);
    }

    public function cart($id){
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            return true;
        } else {

            $cart[$id] = [

                "name" => $product->title,
                "price" => $product->price,
                "category"=> $product->category_id,
                "brand"=> $product->brand_id,
                "image" => $product->photo_link
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }



}
