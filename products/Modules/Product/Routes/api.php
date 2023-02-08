<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
//    'middleware' => ['auth:api'],

], function ($router) {


    // ============Products=============
    Route::group([
        'prefix' => 'products',
    ], function ($router) {

        Route::post('add', [ProductController::class, 'Create'])->name("addProduct");
        Route::post('edit', [ProductController::class, 'update'])->name("updateProduct");
        Route::post('delete', [ProductController::class, 'destroy'])->name("deleteProduct");
        Route::post('product_info', [ProductController::class, 'GetProductInfoById'])->name("getProductInfoById");
        Route::post('list', [ProductController::class, 'ProductsList'])->name("productsList");
        Route::post('filter', [ProductController::class, 'FilterProduct'])->name("filterProducts");
    });


});
