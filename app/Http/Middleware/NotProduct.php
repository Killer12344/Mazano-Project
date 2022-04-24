<?php

namespace App\Http\Middleware;

use App\Product;
use Closure;

class NotProduct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Product::all()->count()==0) {
            return abort('404');
        }

        return $next($request);
    }
}
