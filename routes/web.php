<?php

use App\Http\Controllers\Api\v1\ClientController;
use App\Http\Controllers\Api\v1\OrderClientController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\ProviderController;
use App\Http\Controllers\Api\v1\StatisticsController;
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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/providers', ProviderController::class);
Route::resource('/products', ProductController::class);
Route::resource('/clients', ClientController::class);
Route::resource('/orderclients', OrderClientController::class);

Route::prefix('statistics')->group(function(){

    Route::get('/dailySells', [StatisticsController::class, 'dailySells']);
    Route::get('/monthlySells', [StatisticsController::class, 'monthlySells']);
    Route::get('/bestClient', [StatisticsController::class, 'bestClient']);
});