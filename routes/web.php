<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IpWhitelistController;
use App\Http\Controllers\CustomerCreditCardController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| LOGIN / LOGOUT
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [CustomLoginController::class, 'login'])
    ->name('login.post');

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |-------------------------
    | DASHBOARD
    |-------------------------
    */
    Route::get('/dashboard', function () {
        return view('dashboard-index');
    })->name('dashboard');


    /*
    |-------------------------
    | PROFILE
    |-------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::post('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');


    /*
    |-------------------------
    | EMPLOYEES / USERS
    |-------------------------
    */
    Route::get('/employees', [EmployeeController::class, 'index'])
        ->name('employees.index');

    Route::get('/employees/create', [UserController::class, 'create'])
        ->name('employees.create');

    Route::post('/employees/store', [UserController::class, 'store'])
        ->name('employees.store');

    Route::get('/employees/{id}', [EmployeeController::class, 'show'])
        ->name('employees.show');

    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])
        ->name('employees.destroy');

/*
|-------------------------
| CUSTOMER EDIT / UPDATE
|-------------------------
*/
Route::get(
    '/customers/edit/{id}',
    [CustomerCreditCardController::class, 'edit']
)->name('customers.edit');

Route::put(
    '/customers/update/{id}',
    [CustomerCreditCardController::class, 'update']
)->name('customers.update');

Route::delete(
    '/customers/delete/{id}',
    [CustomerCreditCardController::class, 'destroy']
)->name('customers.delete');

    /*
    |-------------------------
    | CUSTOMER CREDIT CARD FORM
    |-------------------------
    */
    Route::get('/costomers-data-new', function () {
        return view('costomers-new');
    })->name('costomers-new');

    Route::post(
        '/customer-credit-card/save',
        [CustomerCreditCardController::class, 'store']
    )->name('customer.creditcard.save');


    /*
    |-------------------------
    | CUSTOMER LIST
    |-------------------------
    */
    Route::get('/clientdata', [CustomerCreditCardController::class, 'index'])
        ->name('customers.index');


    /*
    |-------------------------
    | IP WHITELIST
    |-------------------------
    */
    Route::get('/ip-whitelist', [IpWhitelistController::class, 'index'])
        ->name('ip.whitelist');

    Route::post('/ip-whitelist', [IpWhitelistController::class, 'store']);

    Route::delete('/ip-whitelist/{id}', [IpWhitelistController::class, 'destroy']);



    /*
|-------------------------------------------------
| WORDPRESS CUSTOMER DATA (ADMIN / SUPER ADMIN)
|-------------------------------------------------
*/
Route::get(
    '/wordpress/customers',
    [CustomerCreditCardController::class, 'wordpressIndex']
)->name('wordpress.customers.index');

Route::get(
    '/wordpress/customers/edit/{id}',
    [CustomerCreditCardController::class, 'wordpressEdit']
)->name('wordpress.customers.edit');

Route::put(
    '/wordpress/customers/update/{id}',
    [CustomerCreditCardController::class, 'wordpressUpdate']
)->name('wordpress.customers.update');

Route::delete(
    '/wordpress/customers/delete/{id}',
    [CustomerCreditCardController::class, 'wordpressDestroy']
)->name('wordpress.customers.delete');

Route::get(
    '/wordpress/customers/{id}/view',
    [CustomerCreditCardController::class, 'wordpressView']
)->name('wordpress.customers.view');

}); // ✅ END auth middleware