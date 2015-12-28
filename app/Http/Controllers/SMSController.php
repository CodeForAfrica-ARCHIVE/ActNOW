<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use View;

class SMSController extends Controller
{
    public function index($number, $text){

        if(strpos(strtolower($text), 'unsubscribe')!==false){
            $returned = $this->unsubscribe($number, $text);
        }else if(strpos(strtolower($text), 'subscribe')!==false){
            $returned = $this->subscribe($number, $text);

        }else if(strpos(strtolower($text), 'sign')!==false){
            $returned = $this->signPetition($number, $text);
        }else{
            $returned = "Request not understood!";
        }

        print $returned;
    }


    /**
     * Sign petition
     * @param $number phone number of user
     * @param $message text message
     * @return string response
     */
    public function signPetition($number, $message){
        //remove first occurrence of 'sign'
        $message = trim(preg_replace('/sign/', '', $message, 1));

        //first word is keyword, the rest is message
        $keyword = explode(' ', trim($message))[0];

        //find petition with the keyword
        $petition = DB::table('petitions')->where('code', $keyword)->first();

        if(empty($petition)){
            $result = "Petition not found!";
        }else{
            $petition_id = $petition->id;

            $user = DB::table('subscribers')->where('number', $number)->first();

            if(empty($user)){
                //register new user
                $user_id = DB::table('subscribers')->insertGetId(['number'=>$number]);
            }else{
                $user_id = $user->id;
            }

            $sign = array("petition"=>$petition_id, "user"=>$user_id, "message"=>$message);
            DB::table('signatures')->insert($sign);

            DB::table('petitions')->where('id', $petition_id)->increment('signatures', 1);
            $result = "Thank you for your signature!";
        }

        return $result;
    }

    /**
     * Function to subscribe user to petition
     * @param $number of user
     * @param $message
     * @return string
     */
    public function subscribe($number, $message){
        //remove first occurrence of 'sign'
        $message = trim(preg_replace('/subscribe/', '', $message, 1));

        //first word is keyword
        $keyword = explode(' ', trim($message))[0];

        //find petition with the keyword
        $petition = DB::table('petitions')->where('code', $keyword)->first();

        if(empty($petition)){
            $result = "Petition not found!";
        }else{
            $petition_id = $petition->id;

            $user = DB::table('subscribers')->where('number', $number)->first();

            if(empty($user)){
                //register new user
                $user_id = DB::table('subscribers')->insertGetId(['number'=>$number]);
            }else{
                $user_id = $user->id;
            }

            //check if user is already subscribed
            $total = DB::table('subscriptions')->where("user",$user_id)->where("petition",$petition_id)->first();

            if(!empty($total)){
                $result = "You are already subscribed to '".$petition->name."'.";
            }else{
                //subscribe user
                $subscription = array('user'=>$user_id, 'petition'=>$petition_id);
                DB::table('subscriptions')->insert($subscription);

                $result = "You have been subscribed to '".$petition->name."'.";
            }
        }

        return $result;
    }

    public function unsubscribe($number, $message){

        //remove first occurrence of 'sign'
        $message = trim(preg_replace('/unsubscribe/', '', $message, 1));

        //first word is keyword, the rest is message
        $keyword = explode(' ', trim($message))[0];

        //find petition with the keyword
        $petition = DB::table('petitions')->where('code', $keyword)->first();

        if(empty($petition)){
            $result = "Petition not found!";
        }else{
            $petition_id = $petition->id;

            $user = DB::table('subscribers')->where('number', $number)->first();

            if(empty($user)){
                $result = "You are not subscribed to any petition";
            }else{
                $user_id = $user->id;

                //check if user is subscribed
                $total = DB::table('subscriptions')->where("user",$user_id)->where("petition",$petition_id)->first();

                if(empty($total)){
                    $result = "You are not subscribed to '".$petition->name."'.";
                }else{
                    //unsubscribe user
                    DB::table('subscriptions')->where('user', $user_id)->where('petition', $petition_id)->delete();

                    $result = "You have been unsubscribed from '".$petition->name."'.";
                }
            }
        }

        return $result;
    }

    /**
     * Broadcast message to all users or specified petition
     * @return mixed
     */
    public function broadcastMessage(){
        $validator = $this->validate_form(Input::all());


        //redirect page depends on petition id
        $petition_id = Input::get('petition_id');
        if($petition_id == 0 || $petition_id == null){
            $redirect = 'subscribers';
            $subscribers = DB::table('subscribers')->get();

        }else{

            $subscribers = DB::table('subscribers')
                ->leftJoin('subscriptions', 'subscribers.id', '=', 'subscriptions.user')
                ->where('subscriptions.petition', $petition_id)
                ->get();
            $redirect = 'subscribers/'.$petition_id;
        }

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to($redirect)
                ->withErrors($validator) // send back all errors to the add petition form
                ->withInput(Input::all());
        } else {
            //on success send messages
            foreach($subscribers as $subscriber){
                $this->sendSMS($subscriber, Input::get('message'));
            }
            //then redirect to list of subscribers
            return Redirect::to($redirect)->with('message', 'Message sent successfully!');
        }
    }

    public function validate_form($input){
        // validate the info, create rules for the inputs
        $rules = array(
            'message'    => 'required|max:145'
        );

        // run the validation rules on the inputs from the form
        return Validator::make($input, $rules);

    }

    /**
     * Function to send sms to specified subscriber
     * @param $subscriber object
     * @param $message
     */
    public function sendSMS($subscriber, $message){

    }

}