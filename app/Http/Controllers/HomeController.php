<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Venue;
use App\User;

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
        return view('home.home');
    }


    /**
     * Display an admin listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function events(Request $request)
    {
        $request->user()->authorizeRoles(['administrator', 'manager']);
        $user_id = auth()->user()->id;

        if (auth()->user()->hasRole('administrator')){
            $events = Event::orderBy('date_to','desc')->get();
        }
        else{
            $events = Event::orderBy('date_to','desc')->where('user_id',$user_id)->get();
        }
        return view('home.events')->with('events',$events);
    }


    /**
     * Display an admin listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function venues(Request $request)
    {
        $request->user()->authorizeRoles(['administrator', 'manager']);
        $venues = Venue::orderBy('name')->get();
        return view('home.venues')->with('venues',$venues);
    }
}
