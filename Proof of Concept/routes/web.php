<?php

use App\Http\Controllers\DataController;
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
    return view('home');
});

Route::controller(DataController::class)->group(function () {
    Route::get('/dataset/{type}', 'dataset')->name('single.dataset');
    Route::get('/datasets', 'datasets')->name('datasets');
    Route::get('/dataset/{type}/{id}/{attr}', 'sensorHistory')->name('sensor.history');
    Route::get('/dataset/{type}/{id}/{attr}/download', 'downloadHistoryAttr')->name('download');
});

