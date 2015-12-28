<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use View;

class RegisterUserController extends Controller
{
    public function index()
    {
        return View::make('register');
    }

    public function doRegister()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email|max:255|unique:users',
            'name'    => 'required',
            'username'    => 'required|max:255|unique:users',
            'password' => 'required|confirmed|alphaNum|min:6' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('register')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password'),
            );

            //register user then login
            User::create(array(
                'name'     => Input::get('name'),
                'username' => Input::get('username'),
                'email'    => Input::get('email'),
                'password' => Hash::make(Input::get('password')),
            ));

            // attempt to do the login
            if (Auth::attempt($userdata)) {
                // validation successful!
                return Redirect::to('dashboard');

            } else {
                // validation not successful, send back to form
                return Redirect::to('login');

            }

        }
    }
}