<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('category', \App\Http\Controllers\CategoryController::class);
Route::resource('product', \App\Http\Controllers\ProductController::class);

Route::get('/categories', [\App\Http\Controllers\CategoryController::class,'getCategoriesWithProducts']);
Route::get('/categories/{id}', [\App\Http\Controllers\CategoryController::class,'getCategoriesWithProductsById']);
Route::get('/categories/{id}/products', [\App\Http\Controllers\ProductController::class,'getProductsByCategoryId']);
Route::get('/categories/{id}/allProducts', [\App\Http\Controllers\ProductController::class,'getAllProductsByCategoryId']);

Route::post('/generate/pin', [\App\Http\Controllers\Controller::class,'generatePin']);
Route::post('/generate/pass', [\App\Http\Controllers\Controller::class,'generatePass']);
