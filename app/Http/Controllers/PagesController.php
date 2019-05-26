<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class PagesController extends Controller
{

    public function index(){
        $upcomingEvents = Event::orderBy('date_from','asc')->where('date_from', '>', now()->format('Y-m-d'))->take(3)->get();
        return view ('pages.index')->with('upcomingEvents',$upcomingEvents);
    }

    public function about(){
        return view ('pages.about');
    }

    public function privacy_policy(){
        return view ('pages.privacy_policy');
    }


}
