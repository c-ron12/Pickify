<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    
    public function user () 
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id'); // user_id is connected to the id in the users table
    }
    public function product () 
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id'); // product_id is connected to the id in the products table 
    }
}