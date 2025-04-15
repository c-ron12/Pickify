<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'recipient_name',
        'recipient_phone',
        'delivery_address',
        'quantity',
        'total_price',
        'payment_method',
        'transaction_id',
        'status',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id'); // user_id is connected to the id in the users table
    }
    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id'); // product_id is connected to the id in the order table 
    }

}
