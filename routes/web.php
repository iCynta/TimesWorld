<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
    Route::get('/product/view/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product');
    Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create-product');
    Route::post('/product/add', [App\Http\Controllers\ProductController::class, 'store'])->name('store-product');
    Route::post('/product/update', [App\Http\Controllers\ProductController::class, 'update'])->name('update-product');
    Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit-product');
    Route::get('/product/delete/{id}', [App\Http\Controllers\ProductController::class, 'disable'])->name('delete-product');
    Route::get('/product/enable/{id}', [App\Http\Controllers\ProductController::class, 'enable'])->name('enable-product');
    Route::get('/product/thrash/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('thrash-product');
    
    Route::post('product/add-image', [App\Http\Controllers\ProductController::class,'store_image'])->name('upload-product-image');
});
