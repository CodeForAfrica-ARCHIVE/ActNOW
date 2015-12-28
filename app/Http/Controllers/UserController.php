<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use View;

class UserController extends Controller
{
    public function __construct()
    {
        //check if user is logged in
        if (!Auth::check()) {
            //redirect to login page
            return Redirect::to('login')->send();
        }
    }

    /**
     * Show user profile
     * @return mixed
     */
    public function myProfile(){

        $user = Auth::user();

        return View::make('my_profile')->with('data', array('user'=>$user));

    }

    /**
     * Edit user profile
     * @return mixed
     */
    public function editProfile(){

        $user = Auth::user();

        return View::make('edit_profile')->with('data', array('user'=>$user));

    }

    public function updateProfile(){
        $validator = $this->validate_form(Input::all());
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('me/edit')
                ->withErrors($validator) // send back all errors to the add petition form
                ->withInput(Input::all());
        } else {
            $user = Auth::user();
            $user->fill(\Input::all());
            $user->save();

            //then redirect to list of subscribers
            return Redirect::to('me')->with('message', 'Profile updated successfully!');
        }
    }

    protected function validate_form(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'username' => 'required',
        ]);

    }

}