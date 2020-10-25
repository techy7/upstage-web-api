<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HelpNotif;
use App\User;
use App\Listing;
use Carbon\Carbon;
use Auth;

class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()){
			return redirect('/home');
		}

	    return view('welcome');
    }
}
