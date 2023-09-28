<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Auth\MobileVerificationController;
use App\Http\Controllers\Public\{
    HomeController,
    PageController,
    OverviewController,
    FilteringProcessController,
    HowController,
    FeaturesController,
    HistoryController,
    QualityController,
    ReportsController,
    FaqController,
    EventController,
    ContactController
};
use App\Http\Controllers\Public\Shop\{
    ShopController,
    CartController,
    OrderController,
};
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

Route::get('/',[HomeController::class,'index'])->name('pub.home');
Route::get('/page/{slug}',[PageController::class,'index'])->name('pub.page');


Route::get('/login-signup',[HomeController::class,'loginSignup'])->name('pub.login.signup');



Route::get('locale/{locale}',[LocalizationController::class,'index']);
require __DIR__.'/auth.php';
