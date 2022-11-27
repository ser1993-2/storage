<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/generate', function () {
    return view('generate');
});

Route::get('/category', function () {
    return view('categories');
});

Route::get('/category/{id}', function ($id) {
    return view('category', ['id' => $id]);
});

Route::get('/product', function () {
    return view('products');
});
