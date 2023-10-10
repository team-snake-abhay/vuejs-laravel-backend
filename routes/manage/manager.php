<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes for Manager
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::prefix('manage')
    ->namespace('App\Http\Controllers\Manage')
    ->group(function () {

        Route::get('dashboard', ['uses' => 'HomeController@index', 'roles' => ['Admin']]);

        
    });

Route::prefix('manage')
    ->namespace('App\Http\Controllers\Admin')
    ->group(function () {
        Route::get('profile', ['uses' => 'AdminUserController@viewProfile', 'roles' => ['Admin']]);
        Route::post('profile', ['uses' => 'AdminUserController@saveProfile', 'roles' => ['Admin']]);

        
    });

