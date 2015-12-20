<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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
            $result = "thanks for your signature";
        }

        return $result;
    }


    public function subscribe($number, $message){
        //remove first occurrence of 'sign'
        $message = trim(preg_replace('/subscribe/', '', $message, 1));

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


            $total = DB::table('subscriptions')->where("user",$user_id)->where("petition",$petition_id)->first();

            if(!empty($total)){
                return "You are already subscribed to '".$petition->name."'.";
            }else{
                $subscription = array('user'=>$user_id, 'petition'=>$petition_id);
                DB::table('subscriptions')->insert($subscription);

                $result = "You have been subscribed to '".$petition->name."'.";
            }
        }

        return $result;
    }
}