<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; // for Auth::user()->id
use App\Models\Cart;

class ShopController extends Controller
{
    public function shop()
    {
        if (Auth::id()) {
            $user = Auth::user();  // gets logged in user
            $user_id = $user->id;  // extracts the id of logged in user and assigns it to $user_id variableS

            $count = Cart::where('user_id', $user_id)->count();  // counts the number of products in the cart of the logged in user
        } else {
            $count = 0;
        }
        return view('shop', compact('count'));
    }
}
