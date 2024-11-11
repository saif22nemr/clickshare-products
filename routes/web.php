<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Employee\HomeController as EmployeeHomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Employee\TaskController as EmployeeTaskController;
use App\Http\Controllers\Manager\DepartmentController as ManagerDepartmentController;
use App\Http\Controllers\Manager\EmployeeController;
use App\Http\Controllers\Manager\HomeController;
use App\Http\Controllers\Manager\TaskController;
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
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    Route::get('home', [AdminHomeController::class, 'index'])->name('home');
    Route::match( ['get' , 'post'] ,'profile', [AdminHomeController::class, 'profile'])->name('profile');
    Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('department', DepartmentController::class)->except(['show']);
    Route::get('manager/{manager}/login-as-manager' , [ManagerController::class , 'loginAsManager'])->name('manager.login');
    Route::resource('manager', ManagerController::class)->except(['show']);
    Route::resource('admin', AdminController::class)->except(['show']);
});


// manager
Route::group(['prefix' => 'manager', 'as' => 'manager.', 'middleware' => 'auth:manager'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::resource('employee', EmployeeController::class)->except(['show']);
    Route::get('department', [ManagerDepartmentController::class , 'index'])->name('department.index');
    Route::resource('task', TaskController::class)->except(['show']);
    Route::post('task/update-status', [TaskController::class , 'updateStatus'])->name('task.updateStatus');
    Route::match( ['get' , 'post'] ,'profile', [HomeController::class, 'profile'])->name('profile');

    Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('logout');
});

// employee
Route::group(['prefix' => 'employee', 'as' => 'employee.', 'middleware' => 'auth:employee'], function () {
    Route::get('home', [EmployeeHomeController::class, 'index'])->name('home');
    Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('logout');


    Route::resource('task', EmployeeTaskController::class)->except(['show' , 'create' , 'store' , 'destory']);
    Route::post('task/update-status', [EmployeeTaskController::class , 'updateStatus'])->name('task.updateStatus');

});
