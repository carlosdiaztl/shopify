<?php

use App\Http\Controllers\ShopifyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
route::resource('users',UserController::class);
route::get('products', [ShopifyController::class, 'getProducts'])->name('products');
route::get('orders', [ShopifyController::class, 'getOrders'])->name('orders');
route::post('create/order', [ShopifyController::class, 'createOrder']);
route::get('store/locations', [ShopifyController::class, 'getStoreLocations'])->name('products');
Route::put('/shopify/product/{productId}', [ShopifyController::class, 'updateProduct']);
Route::post('/shopify/productQuantity', [ShopifyController::class, 'updateProductQuantity']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
