<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes for Admin
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function () {

    Route::get('dashboard', ['uses' => 'HomeController@index', 'roles' => ['Admin']]);
    // Route::get('basic', ['uses' => 'HomeController@view', 'roles' => ['Admin']]);
    // Route::post('basic', ['uses' => 'HomeController@add', 'roles' => ['Admin']]);
    Route::prefix('user')->group(function () {
        Route::get('/', ['uses' => 'AdminUserController@show', 'roles' => ['Admin']]);
        Route::post('/', ['uses' => 'AdminUserController@save', 'roles' => ['Admin']]);
        Route::post('/edit/show', ['uses' => 'AdminUserController@edit', 'roles' => ['Admin']]);
        Route::get('/role', ['uses' => 'AdminUserController@list', 'roles' => ['Admin']]);
        Route::post('/role/assign', ['uses' => 'RoleController@assignRole', 'roles' => ['Admin']]);
    });
    
    
});
Route::prefix('manage')->namespace('App\Http\Controllers\Manage')->group(function () {
    Route::prefix('customer')->group(function () {
        Route::get('/', ['uses' => 'CustomerController@index', 'roles' => ['Admin']])->name('manage.customer');
        Route::get('/subscription/{id}/{subscription}', ['uses' => 'CustomerController@subscriptionUpdate', 'roles' => ['Admin']])->name('manage.customer.subscription');
        Route::get('/status/{id}/{status}', ['uses' => 'CustomerController@customerStatus', 'roles' => ['Admin']])->name('manage.customer.status');
    });
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
