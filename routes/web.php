<?php

use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::fallback(function () {
    return view('404');
});

Route::middleware('auth')->group(function () {  
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () { 
    Route::get('/users', [UserController::class, 'index'])->name('users'); 
    Route::get('/users/status/{id}', [UserController::class, 'status'])->name('user.status'); 
    Route::get('/delete/data/{id}', [UserController::class, 'delete'])->name('delete.data');
    Route::post('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/edit/user/{id}',[UserController::class, 'edit'])->name('edit.user'); 
    Route::post('/update/user',[UserController::class, 'update'])->name('user.update');
    Route::get('/view/user/{id}',[UserController::class, 'view'])->name('user.view');

    Route::get('attendance/report',[AttendanceController::class, 'report'])->name('attendance.report');
});


 

Route::middleware(['auth', 'user-access:user'])->group(function () {  
    Route::get('/punch/in', [AttendanceController::class, 'punch_in'])->name('punch.in');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile'); 
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update'); 
    Route::get('user/report',[UserController::class,'report'])->name('user.report'); 

});
  
  
  


require __DIR__.'/auth.php';
