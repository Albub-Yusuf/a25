<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard2');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Category routes
Route::resource('category',CategoryController::class)->middleware(['auth','verified']);

// Leave Request routes
Route::get('request-waiting-list-admin',[LeaveRequestController::class,'waitingList'])->middleware(['auth','verified'])->name('admin.waiting.list');
Route::get('approved-leave-request/{id}',[LeaveRequestController::class,'approvedRequestForm'])->middleware(['auth','verified'])->name('update.leave.request');
Route::put('update-request',[LeaveRequestController::class,'updateRequest'])->middleware(['auth','verified'])->name('update.request');
Route::get('leave-history',[LeaveRequestController::class,'indexEmployee'])->middleware(['auth','verified'])->name('employee.leave.history');
Route::get('make-leave-request',[LeaveRequestController::class,'getRequestForm'])->middleware(['auth','verified'])->name('make.leave.request');
Route::post('store-request',[LeaveRequestController::class,'makeRequest'])->middleware(['auth','verified'])->name('request.store');


require __DIR__.'/auth.php';
