<?php

namespace App\Http\Controllers;

use App\Product;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function index($slug){


        $product = Product::where('product_slug',$slug)->with('user','category','brand','review.user')->first();

        $currentItem = Product::where('product_slug',$slug)->first();

        $product_id = $currentItem->id;
        $related_id = $currentItem->brand_id;

        $reviews = Review::where('product_id',$product_id)->with('user')->latest('id')->get();

        $related = Product::where('id','!=',$product_id)->orWhere('brand_id','==',$related_id)->limit(5)->get();

        return view('review-product',compact('product', 'related','reviews'));
    }

    public function store(Request $request){
        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->product_id = $request->product_id;
        $review->msg = $request->msg;
        $review->save();
        return redirect()->back();
    }

    public function delete($id){
        $review = Review::where('id',$id)->first();
        $review->delete();
        return redirect()->back();
    }
}
