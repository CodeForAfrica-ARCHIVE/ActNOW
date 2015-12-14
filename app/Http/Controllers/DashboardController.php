<?php
/**
 * Created by PhpStorm.
 * User: nickhargreaves
 * Date: 12/14/15
 * Time: 12:45 PM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use View;

class DashboardController extends Controller
{

    public function __construct()
    {
        //check if user is logged in
        if (!Auth::check()) {
            //redirect to login page
            return Redirect::to('login')->send();
        }
    }

    public function index()
    {
        return View::make('new_petition');
    }

    public function addPetition(){

        // validate the info, create rules for the inputs
        $rules = array(
            'name'    => 'required|min:5',
            'description' => 'required',
            'sms_number' => 'required|numeric|min:4',
            'code' => 'required|alphaNum|min:3'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('dashboard')
                ->withErrors($validator) // send back all errors to the add petition form
                ->withInput(Input::all());
        } else {

            $insert = array(
                "name" => Input::get('name'),
                "description" => Input::get('description'),
                "sms_number" => Input::get('sms_number'),
                "code" => Input::get('code'),
            );

            DB::table('petitions')->insert($insert);

            return View::make('new_petition')->with('success', 'Petition created successfully!');
        }

    }
}