<?php

namespace App\Http\Controllers;

use App\AddToCard;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\String\title;

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

    public function cart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'unique:add_to_cards,product_id',
        ]);

        $request->validate([
            'product_id' => 'unique:add_to_cards,product_id',
        ]);

        $addToCard = new AddToCard();
        $currentItem = Product::find($request->product_id);
        $addToCard->product_id = $currentItem->id;
        $addToCard->user_id = Auth::user()->id;
        $addToCard->category_id = $currentItem->category_id;
        $addToCard->brand_id = $currentItem->brand_id;
        $addToCard->save();

        return response()->json($addToCard);

    }

}
