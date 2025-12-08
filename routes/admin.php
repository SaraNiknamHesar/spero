<!-- contains all admin related routes -->
<!-- چون ادمین نیاز داره بتونه مثلا اگه رمز رو فراموش کرد وارد بشه نمی دونم ریجستر کنه ادمین جدید لاگین کنه -->
<!-- برای همین این کپی همان اث.پی اچ پی است -->

<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
// use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

// in the url or external routing in the chrome prefix('admin') admin/register
// in the internal routing route("admin.login")
// this middle guest must be accessible only when user is a guest 
Route::middleware('guest:admin')->prefix('admin')->as('admin.')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth:admin')->prefix('admin')->as('admin.')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
       Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
// Routes for profiles
   Route::get('/profile',[ProfileController::class,'index'])->name('profile.index');
   Route::put('/profile',[ProfileController::class,'profileUpdate'])->name('profile.update');
   // End routes for profiles
 
});
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard.index');
    // return view('admin.layouts.app');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');
// برای ادمین 