<?php

use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\SellerProductController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {

    Route::controller(ProductController::class)
        ->prefix('/products')
        ->group(function () {
            Route::get('/', 'index');
            Route::get('/{product}', 'show');
            Route::get('/{product}/sellers', 'productSellers');
        });

    Route::get('sellers/{id}/products', SellerProductController::class);
    
});
