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

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    return view('templates.pdf.staffs');
});

Route::prefix('staffs')->group(function() {
    Route::get('/','StaffController@index')->name('get.staffs');
    // Route::post('search/day-work', 'StaffController@searchDayWork')->name('search_days_work');
});
