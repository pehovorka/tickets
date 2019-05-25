<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Venue;
use App\Ticket_user;
use App\User;
use App\User_role;

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
    public function tickets(Request $request)
    {
        $user_id = auth()->user()->id;
        $tickets = Ticket_user::orderBy('created_at','desc')->where('user_id',$user_id)->get();

        return view('home.tickets')->with('tickets',$tickets);
    }


    /**
     * Display an admin listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function venues(Request $request)
    {
        $request->user()->authorizeRoles(['administrator', 'manager']);
        $user_id = auth()->user()->id;

        if (auth()->user()->hasRole('administrator')){
            $venues = Venue::orderBy('name','asc')->get();
        }
        else{
            $venues = Venue::orderBy('name','asc')->where('user_id',$user_id)->get();
        }
        return view('home.venues')->with('venues',$venues);
        
    }

    /**
     * Display an admin listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users(Request $request)
    {
        $request->user()->authorizeRoles(['administrator']);
        $users = User::orderBy('id','asc')->get();
        $roles = User_role::orderBy('id','asc')->get();

        return view('home.users')->with(['users' => $users, 'roles' => $roles]);
    }

    /**
     * Display an admin listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUserRoles(Request $request)
    {
        $request->user()->authorizeRoles(['administrator']);
        //dd($request);
        foreach( $request->get('user') as $id => $user ) {
            if(array_key_exists( 'role', $user )) {
               $usr = User::find( $id );
               $usr->user_role_id = $user['role'];
               $usr->save();
            }
          }
          return redirect('/home/users')->with('success', 'Změny byly uloženy!');
    }
}
