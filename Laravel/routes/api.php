<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('product', controller: ProductController::class);
Route::apiResource('category', controller: CategoryController::class);


Route::post('/payment-sheet', [PaymentController::class, 'showPaymentSheet']);
