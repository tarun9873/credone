<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerCreditCardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔹 ROOT → LOGIN
Route::get('/', function () {
    return redirect('/login');
});

// 🔹 LOGIN PAGE
Route::get('/login', function () {
    return view('auth.login'); // resources/views/auth/login.blade.php
})->name('login');

// 🔹 LOGIN POST
Route::post('/login', [CustomLoginController::class, 'login'])
    ->name('login.post');

// 🔹 LOGOUT
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// 🔹 DASHBOARD (SAME FOR ALL ROLES)
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard-index');
    })->name('dashboard');

    // User create (Admin / Super Admin only)
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users/store', [UserController::class, 'store']);


    // profile show
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    // profile update
    Route::post('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');


    Route::get('/costomers-data-new', function () {
        return view('costomers-new');
    })->name('costomers-new');





    Route::post(
        '/customer-credit-card/save',
        [CustomerCreditCardController::class, 'store']
    )->name('customer.creditcard.save');


    //   Route::get('/all-clientdata', function () {
    //     return view('all-clientdata');
    // })->name('clientdata');

        Route::get('/clientdata', 
        [CustomerCreditCardController::class, 'index']
    )->name('customers.index');


    Route::post('/customers/status/{id}', [CustomerCreditCardController::class,'updateStatus']);
Route::get('/customers/edit/{id}', [CustomerCreditCardController::class,'edit']);
Route::delete('/customers/delete/{id}', [CustomerCreditCardController::class,'destroy']);
Route::put(
    '/customers/update/{id}',
    [CustomerCreditCardController::class, 'update']
)->name('customers.update');


});