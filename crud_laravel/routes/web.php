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

Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
    Route::get('/', 'CustomerController@index')->name('index');
    Route::get('/create', 'CustomerController@create')->name('create');
    Route::get('/{cst_id}', 'CustomerController@showById')->name('showByid');
    Route::post('/store', 'CustomerController@store')->name('store');
    Route::patch('/{cst_id}', 'CustomerController@update')->name('update');
    Route::delete('/{cst_id}', 'CustomerController@delete')->name('delete');
});
