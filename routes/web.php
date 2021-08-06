<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraveController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;

// Auth::routes();


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('login',[AuthController::class,'loginView'])->name('loginView');
Route::get('register',[AuthController::class,'registerShow'])->name('registerShow');
Route::post('login',[AuthController::class,'login'])->name('login');
Route::post('register',[AuthController::class,'register'])->name('register');

Route::middleware(['auth'])->group(function () {

Route::get('/', function () {
    return view('dashboard.home');
});
Route::get('/logout', function () {
    Auth::logout();
    return back();
});
Route::get('grave',[GraveController::class,'index']);
Route::get('grave-card-view',[GraveController::class,'card']);
Route::get('grave-create',[GraveController::class,'create']);
Route::post('grave-store',[GraveController::class,'store']);
Route::get('grave-map',[GraveController::class,'map']);
Route::get('grave-delete',[GraveController::class,'delete']);
Route::get('grave-edit/{id}',[GraveController::class,'edit']);
Route::post('grave-update/{id}',[GraveController::class,'update']);
Route::get('grave-delete/{id}',[GraveController::class,'delete']);


Route::get('owner',[OwnerController::class,'index']);
Route::get('owner-card-view',[OwnerController::class,'card']);
Route::get('owner-create',[OwnerController::class,'create']);
Route::post('owner-store',[OwnerController::class,'store']);
Route::get('owner-edit/{id}',[OwnerController::class,'edit']);
Route::post('owner-update/{id}',[OwnerController::class,'update']);
Route::get('owner-delete/{id}',[OwnerController::class,'delete']);


Route::get('purchase',[PurchaseController::class,'index']);
Route::get('purchase-card-view',[PurchaseController::class,'card']);
Route::get('purchase-create',[PurchaseController::class,'create']);
Route::post('purchase-store',[PurchaseController::class,'store']);
Route::get('purchase-edit/{id}',[PurchaseController::class,'edit']);
Route::post('purchase-update/{id}',[PurchaseController::class,'update']);
Route::get('purchase-delete/{id}',[PurchaseController::class,'delete']);

// report
Route::get('report-graves-by-section',[ReportController::class,'gravesBySection']);
Route::get('report-graves-list-by-name',[ReportController::class,'gravesByName']);
Route::get('list-owner-section-by-purchase-date',[ReportController::class,'gravesBypurchase']);
Route::get('list-grave',[GraveController::class,'index']);
Route::get('list-owner',[OwnerController::class,'index']);
Route::get('burials_by_deceased',[ReportController::class,'burials_by_deceased']);
Route::get('graves-for-sale',[ReportController::class,'graves-for-sale']);


// map
Route::get('core',[GraveController::class,'core']);
Route::get('sections',[GraveController::class,'sections']);

});
