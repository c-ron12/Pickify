<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Auth;

class WhyusController extends Controller
{
    public function why_us()
    {
        if (Auth::id()) {
            $user = Auth::user();  
            $user_id = $user->id;  

            $count = Cart::where('user_id', $user_id)->count(); 
        } else {
            $count = 0;
        }
        return view ('why_us', compact('count'));
    }
}
