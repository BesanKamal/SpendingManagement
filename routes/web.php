<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomeSideController;
use App\Http\Controllers\OperationNameController;
use App\Http\Controllers\SpendingController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    echo "TEST";
});
Route::prefix('cms/admin')->middleware('guest:admin,user')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginView'])->name('cms.login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('cms/admin')->middleware('auth:admin,user')->group(function () {
    Route::view('/', 'cms.temp');
    Route::resource('incomes', IncomeController::class); 
    //Route::resource('users', UserController::class);
    Route::resource('users', UserController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('spendings', SpendingController::class);
    Route::resource('income_sides', IncomeSideController::class);
    Route::resource('operation_names', OperationNameController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');

});
