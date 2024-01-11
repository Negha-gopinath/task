<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('login', [LoginController::class, 'login']);
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/product', [App\Http\Controllers\ProductController::class, 'index']);

Route::middleware('auth:api')->group(function () {

   Route::resource('/category', CategoryController::class)->except(['index']);
   Route::resource('/product', ProductController::class)->except(['index']);

   //  Route::post('logout', [LoginController::class, 'logout']);
});
