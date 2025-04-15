<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [  // this columns should match the name attribute in the form
        'product_name', 
        'brand',
        'store_name',
        'product_category',
        'image',
        'description',
        'price',
        'quantity'
];

}
