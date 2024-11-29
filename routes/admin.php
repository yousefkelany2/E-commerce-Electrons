<?php
use App\Http\Controllers\dash\AdminController;
use App\Http\Controllers\dash\CategoryController;
use App\Http\Controllers\dash\ProductController;
use App\Http\Controllers\dash\UserController;

use Illuminate\Support\Facades\Route;


Route::resource("user",UserController::class);
Route::resource("admin",AdminController::class);
Route::resource("category",CategoryController::class);
Route::resource("product",ProductController::class);

