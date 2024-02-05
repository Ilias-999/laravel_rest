<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\API\RatingController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\UserController;
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

Route::middleware(['auth.api'])->group(function () {

        Route::middleware(['auth:sanctum', 'seller'])->group(function () {

            Route::get('/user', function (Request $request) {
                return $request->user();
            });


            Route::get('products', [ProductController::class, 'index']);
            Route::post('products', [ProductController::class, 'store']);
            Route::get('products/{id}', [ProductController::class, 'show']);
            Route::get('products/{id}/edit', [ProductController::class, 'edit']);
            Route::put('products/{id}/edit', [ProductController::class, 'update']);
            Route::delete('products/{id}/delete', [ProductController::class, 'destroy']);


            Route::get('categories', [CategoryController::class, 'index']);
            Route::get('categories/{id}', [CategoryController::class, 'show']);
            Route::post('categories', [CategoryController::class, 'store']);
            Route::get('categories/{id}/edit', [CategoryController::class, 'edit']);
            Route::put('categories/{id}/edit', [CategoryController::class, 'update']);
            Route::delete('categories/{id}/delete', [CategoryController::class, 'destroy']);


            Route::get('ratings', [RatingController::class, 'index']);
            Route::post('ratings', [RatingController::class, 'store']);
            Route::delete('ratings/{id}/delete', [RatingController::class, 'destroy']);


            Route::get('orders', [OrderController::class, 'index']);
            Route::post('orders', [OrderController::class, 'store']);
            Route::get('orders/{id}', [OrderController::class, 'show']);

            Route::get('orders/{id}/products', [OrderController::class, 'showOrderProducts']);
            Route::post('orders/{id}/products', [OrderController::class, 'addProduct']);
            Route::delete('orders/{id_order}/products/{id_product}', [OrderController::class, 'destroyProduct']);
            Route::put('orders/{id}/producs/{id}', [OrderController::class, 'updateQuantity']);
            Route::delete('orders/{id}/product/products', [OrderController::class, 'destroyAllProducts']);

        });
 });


Route::post('login', [UserController::class, 'login']);


