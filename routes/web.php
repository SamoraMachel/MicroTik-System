<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/test',[App\Helpers\Mpesa::class, 'mpesaRegisterUrls']);
Route::get('/', [App\Http\Controllers\GuestController::class, 'welcome']);
Route::post('/customer/purchase',[App\Http\Controllers\GuestController::class, 'purchase'])->name('purchase');
Auth::routes(['register'=>false]);

Route::post('/mpesa_response',[App\Http\Controllers\GuestController::class, 'responseFromMpesa'])->name('mpesa_response');
Route::post('/validation',[App\Helpers\Mpesa::class, 'mpesaValidation'])->name('mpesa_validate');
Route::post('/confirmation',[App\Helpers\Mpesa::class, 'mpesaConfirmation'])->name('mpesa_confirm');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth')->group(function () {
	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

	Route::get('/add_profiles', [App\Http\Controllers\AdminController::class, 'showForm'])->name('showForm');
	Route::post('/add_profiles', [App\Http\Controllers\AdminController::class, 'newProfile'])->name('newProfile');
	Route::get('/view_profiles', [App\Http\Controllers\AdminController::class, 'listProfiles'])->name('listProfiles');

    Route::get('/router_login', [App\Http\Controllers\HomeController::class, 'routerLogin'])->name('router_login');
    Route::post('/router_verify', [App\Http\Controllers\HomeController::class, 'init'])->name('router_verify');


    // Admin Manage registration of users
    Route::get('admins', [App\Http\Controllers\AdminAnyController::class, 'index'])->name('admin.index');
    Route::get('create', [App\Http\Controllers\AdminAnyController::class, 'create'])->name('admin.create');
    Route::post('store', [App\Http\Controllers\AdminAnyController::class, 'store'])->name('admin.store');
    // Route::get('edit/{user}', [App\Http\Controllers\AdminAnyController::class, 'edit'])->name('admin.edit');
    // Route::get('show/{user}', [App\Http\Controllers\AdminAnyController::class, 'show'])->name('admin.show');
    
});

