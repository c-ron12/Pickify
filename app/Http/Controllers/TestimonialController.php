<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Auth;

class TestimonialController extends Controller
{
    public function testimonial()
    {
        if (Auth::id()) {
            $user = Auth::user();  // gets logged in user
            $user_id = $user->id;  // extracts the id of logged in user and assigns it to $user_id variableS

            $count = Cart::where('user_id', $user_id)->count();  // counts the number of products in the cart of the logged in user
        } else {
            $count = 0;
        }

        return view ('testimonial', compact('count'));
    }
}
