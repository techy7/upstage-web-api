<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HelpNotif;

class HomeController extends Controller
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
        // dd(HelpNotif::unread()->first()->created_at->format('M d, Y'));
        // dd(HelpNotif::unread('App\Notifications\UserNewSignup'));
        return view('home');
    }
}
