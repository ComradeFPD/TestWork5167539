<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarBrandsController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\CarModelsController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login']);

Route::middleware('auth')->group(function (){
    Route::resource('/car-brand', CarBrandsController::class);
    Route::resource('/car-model', CarModelsController::class);
    Route::resource('/car', CarsController::class);
});


