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
}