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
        $petitions = DB::table('petitions')->paginate(15);

        return View::make('dashboard')->with(['petitions' => $petitions]);
    }

    public function newPetition()
    {
        return View::make('new_petition');
    }

    public function addPetition(){
        $validator = $this->validate_form(Input::all());

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('petition/add')
                ->withErrors($validator) // send back all errors to the add petition form
                ->withInput(Input::all());
        } else {
            $user = Auth::user();

            $insert = array(
                "name" => Input::get('name'),
                "description" => Input::get('description'),
                "sms_number" => Input::get('sms_number'),
                "code" => Input::get('code'),
                "created_by" => $user->id,
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

    public function singlePetition($petition_id){

        $petition = DB::table('petitions')->where('id', $petition_id)->first();

        $signatures = DB::table('signatures')->where('petition', $petition_id)->paginate(10);

        $signatures_count = DB::table('signatures')->where('petition', $petition_id)->count();

        $date1=date_create($petition->created_at);
        $date2=date_create(date("Y-m-d"));
        $diff=date_diff($date1,$date2);
        $period = $diff->format("%a days");

        return View::make('single_petition')->with('data', array("petition"=>$petition, "signatures"=>$signatures, "signatures_count"=>$signatures_count, "period"=>$period));

    }

    public function deletePetition($petition_id){

        DB::table('petitions')->where('id', $petition_id)->delete();

        //show result
        return View::make('petition_deleted');
    }

    public function listSubscribers($petition_id=0){
        if($petition_id == 0){
            $subscribers = DB::table('subscribers')->paginate(20);
        }else{
            $subscribers = DB::table('subscribers')
                ->leftJoin('subscriptions', 'subscribers.id', '=', 'subscriptions.user')
                ->where('subscriptions.petition', $petition_id)
                ->paginate(20);
        }

        $petitions = DB::table('petitions')->get();

        return View::make('list_subscribers')->with('data', array("subscribers"=>$subscribers, "petitions"=>$petitions, "current_petition"=>$petition_id));
    }
}