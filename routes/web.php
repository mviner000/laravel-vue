<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Product\ListProduct;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Add your custom registration route
Route::get('/home', function () {
    return view('home-page');
})->name('home');

Route::prefix('product')->group(function(){
    Route::get('/', function () {
        return view('product-page');
    })->name('product');
});

// Route::get('/products', ListProduct::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/dashboard/viewtable', function () {
        return Inertia::render('ViewTable'); // Assuming you have a Vue component named ViewTable
    })->name('viewtable');

    Route::get('/dashboard/upload', function () {
        return Inertia::render('UploadCloudinary'); // Assuming you have a Vue component named ViewTable
    })->name('upload');

    Route::get('/dashboard/viewproduct', function () {
        return Inertia::render('ViewProduct'); // Assuming you have a Vue component named ViewTable
    })->name('viewproduct');

    Route::get('/dashboard/addtable', function () {
        return Inertia::render('AddTable'); // Assuming you have a Vue component named AddTable
    })->name('addtable');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
