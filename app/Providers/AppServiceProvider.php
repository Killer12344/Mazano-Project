<?php

namespace App\Providers;

use App\Brand;
use App\Category;
use App\Order;
use App\Photo;
use App\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('categories',Category::all());
        View::share('brands',Brand::all());
        View::share('products',Product::all());
        View::share('photos',Photo::all());
        View::share('orders',Order::all());
    }
}
