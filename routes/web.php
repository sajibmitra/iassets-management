<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', function(){
    return view('root');
});

Route::resource('iassets','IassetsController');
Route::resource('iusers','IusersController');
Route::resource('ivendors','IvendorsController');
Route::resource('iworkstations','IworkstationsController');
Route::resource('iresponses','IresponsesController');
Auth::routes();
