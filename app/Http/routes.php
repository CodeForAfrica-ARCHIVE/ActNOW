<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return Redirect::to('dashboard');
});

Route::get('dashboard', array('uses' => 'DashboardController@index'));

// route to show the login form
Route::get('login', array('uses' => 'LoginController@showLogin'));

// route to process the form
Route::post('login', array('uses' => 'LoginController@doLogin'));

// logout
Route::get('logout', array('uses' => 'LoginController@doLogout'));

//add petition
Route::post('add_petition', array('uses' => 'DashboardController@addPetition'));