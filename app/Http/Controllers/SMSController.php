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

            mail('actnowsms@gmail.com', $number, $returned);
        }else if(strpos(strtolower($text), 'subscribe')!==false){
            $returned = $this->subscribe($number, $text);

            mail('actnowsms@gmail.com', $number, $returned);
        }else if(strpos(strtolower($text), 'register')!==false){
            $returned = $this->register($number, $text);

            mail('actnowsms@gmail.com', $number, $returned);
        }else if(strpos(strtolower($text), 'sign')!==false){
            $returned = $this->signPetition($number, $text);
            mail('actnowsms@gmail.com', $number, $returned);
        }
    }

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

        print $result;
    }
}