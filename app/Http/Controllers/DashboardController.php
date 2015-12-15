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
        $validator = $this->validate_form(Input::all());

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

    public function editPetition($petition_id){

        $petition = DB::table('petitions')->where('id', $petition_id)->first();

        return View::make('edit_petition')->with('petition', $petition);
    }

    public function updatePetition(){
        $validator = $this->validate_form(Input::all());

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('dashboard')
                ->withErrors($validator) // send back all errors to the add petition form
                ->withInput(Input::all());
        } else {

            $update_array = array(
                "name" => Input::get('name'),
                "description" => Input::get('description'),
                "sms_number" => Input::get('sms_number'),
                "code" => Input::get('code'),
            );

            DB::table('petitions')->where('id', Input::get('id'))->update($update_array);


        }

    }

    public function validate_form($input){
        // validate the info, create rules for the inputs
        $rules = array(
            'name'    => 'required|min:5',
            'description' => 'required',
            'sms_number' => 'required|numeric|min:4',
            'code' => 'required|alphaNum|min:3'
        );

        // run the validation rules on the inputs from the form
        return Validator::make($input, $rules);

    }
}