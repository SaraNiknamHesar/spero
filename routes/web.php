<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// وقتی از بریز استفاده می کنیم این میاد وریفیکشن رو انجام میده و میبره مارو به داشبورد بعد از لاگین

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard.index');
    // return view('admin.layouts.app');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');
// برای ادمین 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
