<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('products', [ProductController::class, 'index'])->name('product');
Route::get('products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('products', [ProductController::class, 'store'])->name('product.store');
Route::get('products/{id}', [ProductController::class, 'productView'])->name('product.view');
Route::DELETE('products/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');
Route::get('products/{id}/edit', [ProductController::class, 'productEdit'])->name('product.edit');
Route::PUT('products/{id}', [ProductController::class, 'productUpdate'])->name('product.update');
