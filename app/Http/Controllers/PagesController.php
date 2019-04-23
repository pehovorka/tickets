<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function index(){
        return view ('pages.index');
    }

    public function events(){
        return view ('pages.events');
    }

    public function about(){
        return view ('pages.about');
    }


}
