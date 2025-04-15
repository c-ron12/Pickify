<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WhyusController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactUsController;

// user view
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/shop', [ShopController::class, 'shop']);
Route::get('/why_us', [WhyusController::class, 'why_us']);
Route::get('/testimonial', [TestimonialController::class, 'testimonial']);
Route::get('/contact_us', [ContactusController::class, 'contact_us']);

Route::get('/dashboard', [HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('add_to_cart/{id}', [HomeController::class, 'add_to_cart'])->middleware(['auth', 'verified']);
Route::get('product_details/{id}', [HomeController::class, 'product_details']);
Route::get('mycart', [HomeController::class, 'mycart'])->middleware(['auth', 'verified']);
Route::get('buy_product/{id}', [HomeController::class, 'buy_product'])->middleware(['auth', 'verified']); 
Route::post('place_order/{id}', [HomeController::class, 'place_order'])->middleware(['auth', 'verified']); 
Route::get('myorders', [HomeController::class, 'myorders'])->middleware(['auth', 'verified'])->name('myorders');
Route::get('order_details/{id}', [HomeController::class, 'order_details'])->middleware(['auth', 'verified'])->name('order.details');
Route::post('/order/{id}/cancel', [HomeController::class, 'cancel'])->name('order.cancel')->middleware(['auth', 'verified']);

Route::get('search_product', [HomeController::class, 'search_product'])->name('search.product');
Route::get('remove_from_cart/{id}', [HomeController::class, 'remove_from_cart'])->middleware(['auth', 'verified']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// admin dashboard 
Route::get('admin/dashboard',[HomeController::class, 'index'])->middleware(['auth', 'admin']);
Route::get('view_category',[AdminController::class, 'view_category'])->middleware(['auth', 'admin']);
Route::post('add_category',[AdminController::class, 'add_category'])->middleware(['auth', 'admin']);
Route::get('delete_category/{id}',[AdminController::class, 'delete_category'])->middleware(['auth', 'admin'])->name('delete.category');
Route::get('edit_category/{id}',[AdminController::class, 'edit_category'])->middleware(['auth', 'admin'])->name('edit.category');
Route::post('update_category/{id}',[AdminController::class, 'update_category'])->middleware(['auth', 'admin']);
Route::get('add_product',[AdminController::class, 'add_product'])->middleware(['auth', 'admin']);
Route::post('upload_product',[AdminController::class, 'upload_product'])->middleware(['auth', 'admin']);
Route::get('view_product',[AdminController::class, 'view_product'])->middleware(['auth', 'admin']);
Route::get('delete_product/{id}', [AdminController::class, 'delete_product'])->middleware(['auth', 'admin']);
Route::get('edit_product/{id}', [AdminController::class, 'edit_product'])->middleware(['auth', 'admin']);
Route::post('update_product/{id}', [AdminController::class, 'update_product'])->middleware(['auth', 'admin']);

Route::get('admin/search_product', [AdminController::class, 'search_product'])->middleware(['auth', 'admin']);

Route::get('view_order', [AdminController::class, 'view_order'])->middleware(['auth', 'admin']); 
Route::get('on_the_way/{id}', [AdminController::class, 'on_the_way'])->middleware(['auth', 'admin']); 
Route::get('delivered/{id}', [AdminController::class, 'delivered'])->middleware(['auth', 'admin']); 
Route::get('print_pdf/{id}', [AdminController::class, 'print_pdf'])->middleware(['auth', 'admin']); 


// user view





