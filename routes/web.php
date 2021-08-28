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
Route::get('/', 'LinkController@index');
Route::post('generate_short_code', 'LinkController@generate')->name('generate.short.code.post');
Route::get('{url}', 'LinkController@shortCode')->name('short.code');