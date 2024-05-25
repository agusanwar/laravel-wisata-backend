<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function(){
    Route::get('home', function() {
        return view('pages.dashboard');
    })->name('home');

   Route::resource('users', UserController::class);
   Route::resource('categories', CategoryController::class);
   Route::resource('products', ProductController::class);
});