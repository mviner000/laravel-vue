<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('addnewuser', [UserController::class, 'store']);
Route::put('usersupdate/{id}', [UserController::class, 'update']);
Route::delete('usersdelete/{id}', [UserController::class, 'destroy']); 

Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);
Route::post('addnewproduct', [ProductController::class, 'store']);
Route::put('productsupdate/{id}', [ProductController::class, 'update']);
Route::delete('productsdelete/{id}', [ProductController::class, 'destroy']); 