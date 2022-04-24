<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    function user(){
        return $this->belongsTo(User::class);
    }

    function product(){
        return $this->hasMany(Product::class);
    }
}
