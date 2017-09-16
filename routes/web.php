<?php

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

Route::get('/distant', 'DistantController@index');
Route::get('/distant/usecase', 'DistantController@usecase');
Route::get('/near', 'NearController@index');
Route::get('/near/usecase', 'NearController@usecase');
Route::get('/go_to_city', 'DistantController@goToCityUsecase');

