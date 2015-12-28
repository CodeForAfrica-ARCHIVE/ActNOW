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
Route::get('petition/add', array('uses' => 'DashboardController@newPetition'));

//process add petition
Route::post('add_petition', array('uses' => 'DashboardController@addPetition'));

//edit petition
Route::get('petition/edit/{id}', array('uses' => 'DashboardController@editPetition'));

//process edit petition
Route::post('edit_petition', array('uses' => 'DashboardController@updatePetition'));

//view petition
Route::get('petition/{id}', array('uses' => 'DashboardController@singlePetition'));

//delete petition
Route::get('petition/delete/{id}', array('uses' => 'DashboardController@deletePetition'));

//sign petition
Route::get('sms/{number}/{message}', array('uses' => 'SMSController@index'));

//view subscribers
Route::get('subscribers', array('uses'=>'DashboardController@listSubscribers'));

//view subscribers for petition id
Route::get('subscribers/{id}', array('uses'=>'DashboardController@listSubscribers'));

//broadcast message to subscribers of specified petition
Route::post('broadcast', array('uses'=>'SMSController@broadcastMessage'));

//show user profile
Route::get('me', array('uses' => 'UserController@myProfile'));

//edit user profile
Route::get('me/edit', array('uses' => 'UserController@editProfile'));

//process edit profile
Route::post('me/edit', array('uses' => 'UserController@updateProfile'));
