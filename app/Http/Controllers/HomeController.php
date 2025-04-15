<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;

use Auth;    // for Auth::user()->id

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('usertype', 'user')->get()->count();

        $product = Product::all()->count();
        $order = Order::all()->count();

        $delivered = Order::where('status', 'Delivered')->get()->count();

        return view('admin.index', compact('user', 'product', 'order', 'delivered'));
    }

    public function home()
    {
        $product = Product::take(8)->get();
        if (Auth::id()) {
            $user = Auth::user();  // gets logged in user
            $user_id = $user->id;  // extracts the id of logged in user and assigns it to $user_id variableS

            $count = Cart::where('user_id', $user_id)->count();  // counts the number of products in the cart of the logged in user
        } else {
            $count = 0;
        }

        return view('home', compact('product', 'count'));
    }

    public function login_home()
    {
        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user(); // gets logged in user
            $user_id = $user->id;  // extracts the id of logged in user and assigns it to $user_id variableS

            $count = Cart::where('user_id', $user_id)->count();  // counts the number of products in the cart of the logged in user
        } else {
            $count = 0;
        }
        return view('home', compact('product', 'count'));
    }

    public function product_details($id)
    {
        $data = Product::find($id);
        if (Auth::id()) {
            $user = Auth::user(); // gets logged in user
            $user_id = $user->id;  // extracts the id of logged in user  and assigns it to $user_id variableS

            $count = Cart::where('user_id', $user_id)->count();  // counts the number of products in the cart of the logged in user
        } else {
            $count = 0;
        }

        return view('product_details', compact('data', 'count'));
    }

    public function add_to_cart($id)
    {
        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;

        $data = new Cart;
        $data->user_id = $user_id;          // user_id is the column name in the cart table 
        $data->product_id = $product_id;    // product_id is the column name in the cart table

        $data->save();
        session()->flash('toastr', 'Product added to your cart successfully');
        return redirect()->back();
    }

    public function mycart()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();

            $cart = Cart::where('user_id', $user_id)->get();
        } else {
            $count = 0;
        }

        return view('mycart', compact('count', 'cart'));
    }

    public function buy_product($id)
    {
        $data = Product::find($id);  // gets the product with the id passed in the url

        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();

            $cart = Cart::where('user_id', $user_id)->get();
        } else {
            $count = 0;
        }

        return view('buy_product', compact('count', 'cart', 'data'));
    }

    public function place_order(Request $request, $id)
    {
        // Get the logged-in user
        $user_id = Auth::user()->id; // extracts the id of logged in user
        $recipient_name = $request->recipient_name;    // extracts the recipient_name from the form
        $recipient_phone = $request->recipient_phone;
        $delivery_address = $request->delivery_address;
        $email = $request->email;
        $color_family = $request->color_family;
        $payment_method = $request->payment_method;
        $transaction_id = $request->transaction_id;
        $status = 'in process';  // Set default order status

        // Check if the order is being placed from the cart or directly from the product details
        $cart_item = Cart::where('user_id', $user_id)->where('product_id', $id)->first();

        // Case 1: If order is placed from the cart
        if ($cart_item) {
            // Fetch the product from the cart (because the user is placing an order from their cart)
            $product = Product::find($cart_item->product_id);

            // Ensure the quantity is taken from the cart
            $quantity = $cart_item->quantity;

            if (!$product) {
                return redirect()->back()->with('error', 'Product not found in cart.');
            }

            $quantity = $request->quantity; // This should be passed from the form on the cart page
        }
        // Case 2: If order is placed directly from the product details page
        else {
            // Fetch the product from the Product model
            $product = Product::find($id);

            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }

            // Use the quantity from the request (for direct purchase from product detail page/buy_product page)
            $quantity = $request->quantity; // This should be passed from the form on the product details page
        }

        // Now proceed with creating the order
        $order = new Order;
        $order->recipient_name = $recipient_name;
        $order->recipient_phone = $recipient_phone;
        $order->email = $email;
        $order->delivery_address = $delivery_address;
        $order->quantity = $quantity;
        $order->color_family = $color_family;
        $order->total_price = $product->price * $quantity;
        $order->payment_method = $payment_method;
        $order->transaction_id = $transaction_id;
        $order->status = $status;
        $order->user_id = $user_id;
        $order->product_id = $product->id;
        $order->save();

        // If the order was placed from the cart, remove the cart item
        if ($cart_item) {
            $cart_item->delete();
        }

        // Flash message for successful order placement
        session()->flash('toastr', 'Your Order has been placed successfully');

        // Redirect to the home page after placing the order
        return redirect('/')->with('products', Product::take(8)->get());
    }

    public function myorders()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();

            $cart = Cart::where('user_id', $user_id)->get();

            $order = Order::where('user_id', $user_id)->get();
        } else {
            $count = 0;
        }

        return view('myorder', compact('count', 'cart', 'order'));
    }

    public function order_details($id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
            $cart = Cart::where('user_id', $user_id)->get();
        } else {
            $count = 0;
            $cart = collect(); // Return empty collection if user is not logged in
        }

        $order = Order::find($id);

        return view('order_details', compact('order', 'count', 'cart'));
    }

    public function cancel($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->route('myorders')->with('error', 'Order not found!');
        }

        $order->delete();
        session()->flash('toastr', 'Order cancelled successfully');

        return redirect()->route('myorders'); // Ensure redirection to order list
    }

    public function search_product(Request $request)
    {
        // Authentication check
        $count = 0;
        $cart = [];

        if (Auth::check()) {
            $user_id = Auth::id();
            $count = Cart::where('user_id', $user_id)->count();
            $cart = Cart::where('user_id', $user_id)->get();
        }

        // Search logic
        $search = $request->input('search');
        $products = Product::where('product_name', 'LIKE', "%{$search}%")->orWhere('category', 'LIKE', "%{$search}%")->paginate(6);

        return view('search_product', compact('count', 'cart', 'products', 'search'));
    }


    public function remove_from_cart($id)
    {
        // Find the cart item for the authenticated user and the specified product
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
            session()->flash('toastr', 'Product has been removed from your cart');
            return redirect()->back();
        }
       

        return redirect()->back()->with('error', 'Product not found in your cart.');
    }

}
