<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $products = Product::when(isset(request()->search),function ($query){
            $search = \request()->search;
            return $query->where('title','like',"%$search%");
        })->with('user','category','brand')->latest('id')->paginate(6);



        return view('welcome',compact('products'));

    }

    public function orderByCat($slug){
        $products = Product::when(isset(request()->search),function ($query){
            $search = \request()->search;
            return $query->where('title','like',"%$search%");
        })->where('category_slug',$slug)->with('user','category','brand')->latest('id')->paginate(6);

        return view('welcome',compact('products'));
    }

    public function orderByBrand($slug){
        $products = Product::when(isset(request()->search),function ($query){
            $search = \request()->search;
            return $query->where('title','like',"%$search%");
        })->where('brand_slug',$slug)->with('user','category','brand')->latest('id')->paginate(6);

        return view('welcome',compact('products'));
    }

    public function orderByPrice(Request $request){

        $request->validate([
            'min_price'=>'required|integer',
            'max_price'=>'required|integer'
        ]);

        $products = Product::when(isset(request()->search),function ($query){
            $search = \request()->search;
            return $query->where('title','like',"%$search%");
        })->whereBetween('price',[$request->min_price,$request->max_price])->with('user','category','brand')->latest('id')->paginate(5);

        return view('welcome',compact('products'));

    }

    public function priceDesc(){

        $products = Product::when(isset(request()->search),function ($query){
            $search = \request()->search;
            return $query->where('title','like',"%$search%");
        })->with('user','category','brand')->orderBy('price','desc')->paginate(6);

        return view('welcome',compact('products'));

        // $products = Product::where('price')->with(['user','categoey','brand'])->paginate(5);
        // return view('welcome',compact('products'));

    }

    public function priceAsc(){

        $products = Product::when(isset(request()->search),function ($query){
            $search = \request()->search;
            return $query->where('title','like',"%$search%");
        })->with('user','category','brand')->orderBy('price','asc')->paginate(6);

        return view('welcome',compact('products'));

    }

    public function showDetail($slug){
        $product = Product::where('product_slug',$slug)->with('user','category','brand')->first();

        $currentItem = Product::where('product_slug',$slug)->first();

        $product_id = $currentItem->id;
        $related_id = $currentItem->brand_id;

        $related = Product::where('id','!=',$product_id)->orWhere('brand_id','==',$related_id)->limit(5)->get();

        return view('show-detail',compact('product', 'related'));
    }

}
