<?php
/**
 * Created by PhpStorm.
 * User: nickhargreaves
 * Date: 12/14/15
 * Time: 12:45 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use Knp\Snappy\Pdf;
use View;

class DashboardController extends Controller
{

    public $isAdmin = false;
    public $user_id = 0;

    public function __construct()
    {

        //if route is embed no need to check authentication
        $route = Route::getFacadeRoot()->current()->uri();
        if($route != "embed/{id}"){
            //check if user is logged in
            if (!Auth::check()) {
                //redirect to login page
                return Redirect::to('login')->send();
            } else {
                //check if user is admin
                $user = Auth::user();
                if ($user->isAdmin == "1") {
                    $this->isAdmin = true;
                }
                $this->user_id = $user->id;
            }
        }
    }

    public function index()
    {
        if($this->isAdmin) {
            $petitions = DB::table('petitions')->paginate(15);
        }else{
            $petitions = DB::table('petitions')->where('created_by', $this->user_id)->paginate(15);
        }

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
                "status" => Input::get('status'),
                "created_by" => $user->id,
            );

            DB::table('petitions')->insert($insert);

            return View::make('new_petition')->with('success', 'Petition created successfully!');
        }

    }

    public function editPetition($petition_id){

        $petition = DB::table('petitions')->where('id', $petition_id)->first();

        if(($petition->created_by != $this->user_id)&&(!$this->isAdmin)){
            return View::make('access_denied')->with('message', 'You can only edit your own petitions!');
        }else {
            return View::make('edit_petition')->with('petition', $petition);
        }
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
                "status" => Input::get('status'),
            );

            $petition = DB::table('petitions')->where('id', Input::get('id'))->first();

            if(($petition->created_by != $this->user_id)&&(!$this->isAdmin)){
                return View::make('access_denied')->with('message', 'You can only edit your own petitions!');
            }else {
                DB::table('petitions')->where('id', Input::get('id'))->update($update_array);

                return Redirect::to('petition/edit/'.Input::get('id'))->with('message', 'Petition updated successfully!');
            }
        }

    }

    public function validate_form($input){
        // validate the info, create rules for the inputs
        $rules = array(
            'name'    => 'required|min:5',
            'description' => 'required',
            'sms_number' => 'required|numeric|min:4',
            'code' => 'required|alphaNum|min:3',
            'status' => 'required'
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

        if(($petition->created_by != $this->user_id)&&(!$this->isAdmin)){
            return View::make('access_denied')->with('message', 'You can only view your own petitions!');
        }else {
            return View::make('single_petition')->with('data', array("petition" => $petition, "signatures" => $signatures, "signatures_count" => $signatures_count, "period" => $period));
        }
    }

    public function deletePetition($petition_id){

        $petition = DB::table('petitions')->where('id', $petition_id)->first();
        if(($petition->created_by != $this->user_id)&&(!$this->isAdmin)){
            return View::make('access_denied')->with('message', 'You can only delete your own petitions!');
        }else {
            DB::table('petitions')->where('id', $petition_id)->delete();
        }

        //show result
        return View::make('petition_deleted');
    }

    public function listSubscribers($petition_id=0){
        if($petition_id == 0){
            if($this->isAdmin) {
                $subscribers = DB::table('subscribers')->paginate(20);
            }else{
                $subscribers = DB::table('subscribers')
                    ->leftJoin('subscriptions', 'subscribers.id', '=', 'subscriptions.user')
                    ->leftJoin('petitions', 'petitions.id', '=', 'subscriptions.petition')
                    ->where('petitions.created_by', $this->user_id)
                    ->paginate(20);
            }
        }else{
            if($this->isAdmin) {
                $subscribers = DB::table('subscribers')
                    ->leftJoin('subscriptions', 'subscribers.id', '=', 'subscriptions.user')
                    ->where('subscriptions.petition', $petition_id)
                    ->paginate(20);
            }else{
                $subscribers = DB::table('subscribers')
                    ->leftJoin('subscriptions', 'subscribers.id', '=', 'subscriptions.user')
                    ->leftJoin('petitions', 'petitions.id', '=', 'subscriptions.petition')
                    ->where('petitions.created_by', $this->user_id)
                    ->where('subscriptions.petition', $petition_id)
                    ->paginate(20);
            }
        }

        if($this->isAdmin) {
            $petitions = DB::table('petitions')->get();
        }else{
            $petitions = DB::table('petitions')->where('created_by', $this->user_id)->get();
        }

        return View::make('list_subscribers')->with('data', array("subscribers"=>$subscribers, "petitions"=>$petitions, "current_petition"=>$petition_id));
    }

    public function embedPetition($petition_id){

        $petition = DB::table('petitions')->where('id', $petition_id)->first();

        return View::make('embed_petition')->with('petition', $petition);

    }

    public function exportCSV($petition_id){

        $petition = DB::table('petitions')->where('id', $petition_id)->first();
        if(($petition->created_by != $this->user_id)&&(!$this->isAdmin)){
            return View::make('access_denied')->with('message', 'You can only export your own petitions!');
        }else {

            $signatures = DB::table('signatures')->where('petition', $petition_id)->get();

            $output = implode(",", array('Message', 'Date signed'))."\n";

            foreach ($signatures as $row) {
                $output .=  implode(",", array($row->message, $row->created_at))."\n";
            }


            $headers = array(
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="signatures.csv"',
            );

            // download response
            return Response::make(rtrim($output, "\n"), 200, $headers);

        }
    }

    public function exportPDF($petition_id){

        $snappy = App::make('snappy.pdf');

        //Or output:
        return Response::make(
            $snappy->getOutputFromHtml(''),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );
    }
}