<?php
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home.index');
});


Route::group(['middleware'=>['auth','verified']],function(){
    Route::get('/dashboard',[UserDashboardController::class,'index'])->name('dashboard');
});






<<<<<<< HEAD

=======
>>>>>>> e968e4f9a45eacd397f7325423efa851a4a15952

require __DIR__ . '/auth.php';
