<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\website\CartController;
use App\Http\Controllers\website\EcomController;
use App\Http\Controllers\website\LoginController;
use App\Http\Controllers\website\RegisterController;

Route::get('/', function () {
 return to_route("eccom.index");
});
Route::resource("cart",CartController::class);
Route::resource('eccom', EcomController::class);
Route::resource("login",LoginController::class);
Route::resource("register",RegisterController::class);
Route::get('/eccom/{productId}/{categoryId}', [EcomController::class, 'show'])->name('eccom.show');
