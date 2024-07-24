
<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::post('/submit-form', [ProductController::class, 'submitForm'])->name('submit.form');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');


Route::get('/product_edit/{id}', [ProductController::class, 'edit']);
Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');



Route::get('/product/{id}', [ProductController::class, 'show_single_product'])->name('product.show');
