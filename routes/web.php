<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraveController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PurchaseController;

Route::get('/', function () {
    return view('dashboard.home');
});

// Auth::routes();


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('login',[AuthController::class,'show'])->name('login');
// Route::post('login',[AuthController::class,'login'])->name('login');
Route::get('grave',[GraveController::class,'index']);
Route::get('owner',[OwnerController::class,'index']);
Route::get('purchase',[PurchaseController::class,'index']);
