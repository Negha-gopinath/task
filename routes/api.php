<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::post('/login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
});
Route::resource('/category', CategoryController::class);
Route::resource('/product', ProductController::class);
