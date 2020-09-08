<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HelpNotif;
use App\User;
use App\Listing;
use Carbon\Carbon;

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
        $newUsers = User::where('created_at', '>', Carbon::now()->subDays(7))->count();
        $allUsers = User::count();

        $newListings = Listing::where('created_at', '>', Carbon::now()->subDays(7))->count();
        $allListings = Listing::count(); 

        $latestUsers = User::limit(5)->orderBy('created_at', 'desc')->with(['plan'])->get();
        $latestListings = Listing::limit(6)->orderBy('created_at', 'desc')->with(['user'])->get();
         
        // dd(HelpNotif::unread()->first()->created_at->format('M d, Y'));
        // dd(HelpNotif::unread('App\Notifications\UserNewSignup'));
        return view('home', compact('newListings', 'newUsers', 'allListings', 'allUsers', 'latestUsers', 'latestListings'));
    }
}
