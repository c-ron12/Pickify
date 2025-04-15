<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::all();  // you should use $data variable as you are passing it to the category.blade.php view

        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->category;
        $category->save();

        // toastr()->closeButton()->timeOut(10000)->success('Category added succesfully');
        session()->flash('toastr', 'Category added successfully');

        return redirect()->back();
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            session()->flash('toastr', 'Category deleted successfully');
        } else {
            session()->flash('toastr', 'Category not found');
        }

        return redirect()->back();
    }

    public function edit_category($id)
    {
        $category = Category::find($id);
        return view('admin.edit_category', compact('category'));
    }

    public function update_category(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->category_name = $request->category;
            $category->save();
            session()->flash('toastr', 'Category updated succesfully');
            return redirect('/view_category');
        } else {
            session()->flash('toastr', 'Category not found');
        }
    }

    public function add_product()
    {
        $category = Category::all();
        return view('admin.add_product', compact('category'));
    }

    public function upload_product(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'brand' => 'required',
            'product_category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',   //  max: 2048 means the maximum file size to upload should be less than 2048 kilobytes (KB)/ 2 mb,
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric',
        ]);

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->brand = $request->brand;
        $product->category = $request->product_category;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/database_img');
            $image->move($destinationPath, $name);
            $product->image = $name;
        } else {
            $product->image = null; // Explicitly setting null if no image is uploaded
        }

        $product->save();
        session()->flash('toastr', 'Product added sucessfully');
        return redirect()->back();
    }

    public function view_product()
    {
        $data = Product::paginate(5);
        // $data = Product::paginate(1);
        // $data = Product::all();
        return view('admin.view_product', compact('data'));
    }

    public function edit_product($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.edit_product', compact('product', 'category'));

    }
    public function update_product(Request $request, $id)
    {
        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->brand = $request->brand;
        $product->store_name = $request->store_name;
        $product->category = $request->product_category;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
    
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image && file_exists(public_path('images/database_img/' . $product->image))) {
                unlink(public_path('images/database_img/' . $product->image));
            }
    
            // Upload the new image
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/database_img');
            $image->move($destinationPath, $name);
            $product->image = $name;
        }
    
        $product->save();
        session()->flash('toastr', 'Product updated sucessfully');
        return redirect("view_product");
    }

    public function delete_product($id)
    {
        $product = Product::find($id);

        if ($product && $product->image) { // Check if product and image exist
            $image_path = public_path('images/database_img/' . $product->image);

            if (file_exists($image_path) && is_file($image_path)) { // Ensure it's a file before deleting
                unlink($image_path);
            }
        }

        if ($product) {
            $product->delete();
            session()->flash('toastr', 'Product has been deleted successfully');
        }

        return redirect()->back();
    }


    public function search_product(Request $request)
    {
        $search = $request->search;
        $data = Product::where('product_name', 'LIKE', '%' . $search . '%')->orWhere('category', 'LIKE', '%' . $search. '%')->paginate(5); //you should use $data variable as you are passing it to the view_product.blade.php

        return view('admin.view_product', compact('data'));
    }


    public function view_order()
    {
        $data = Order::paginate(10);       // you should use $data variable as you are passing it to the view_order.blade.php
        return view('admin.view_order', compact('data'));
    }

    public function on_the_way($id)
    {
        $data = Order::find($id);
        $data->status = 'On the way';
        $data->save();
        return redirect('/view_order');
    }
    public function delivered($id)
    {
        $data = Order::find($id);
        $data->status = 'Delivered';
        $data->save();
        return redirect('/view_order');
    }

    public function print_pdf($id)
    {
        $data = Order::find($id);

        $pdf = Pdf::loadView('admin.invoice', compact('data'));
        return $pdf->download('invoice.pdf');
    }


}
