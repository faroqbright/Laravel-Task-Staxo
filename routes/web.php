<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Purchase;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    $products = Product::all(); 

 
    return view('welcome', compact('products'));
});

Route::get('/dashboard', function () {
    
    $userproducts = Purchase::where('user_id', auth()->user()->id)->get();
    // dd($userproducts);
    return view('dashboard', compact('userproducts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    $products = Product::all(); // Example: Fetch all products

    return view('admin.dashboard', compact('products'));
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/checkout/{id}', [StripeController::class, 'checkout'])->name('product.checkout');


    Route::get('/thanks/{id}/{cus_id}', [ProductController::class, 'thanks'])->name('thanks');

    
    Route::get('/checkout/{id}', [StripeController::class, 'checkout'])->name('product.checkout');
    Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');
 
});

require __DIR__.'/auth.php';



Route::get('/admin/dashboard', function () {
    $products = Product::all(); // Example: Fetch all products

    return view('admin.dashboard', compact('products'));
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

require __DIR__.'/AdminAuth.php';

require 'product.php';