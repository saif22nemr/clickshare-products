<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TestController;
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
    return redirect(route('login'));
});
Route::get('test' , [TestController::class , 'index']);
Route::match(['get', 'post'], 'login', [LoginController::class, 'login'])->name('login');
Route::match(['get', 'post'], 'login-as/{type}', [LoginController::class, 'loginAs'])->name('loginAs');
Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('logout');
// admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:web'], function () {
    Route::get('home', [AdminHomeController::class, 'index'])->name('home');
    Route::match( ['get' , 'post'] ,'profile', [AdminHomeController::class, 'profile'])->name('profile');
    Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('product', ProductController::class)->except(['show']);
    Route::resource('admin', AdminController::class)->except(['show']);
});


