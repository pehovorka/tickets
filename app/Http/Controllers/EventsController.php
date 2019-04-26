<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('events.index')->with('events',$events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['administrator', 'manager']);
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['administrator', 'manager']);
        $this->validate($request, [
            'name' => 'required|max:80',
            'description' => 'required',
            'date_from' => 'required|date_format:Y-m-d|after:yesterday',
            'date_to' => 'required|date_format:Y-m-d|after_or_equal:date_from'
        ]);

        $event = new Event;
        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->date_from = $request->input('date_from');
        $event->date_to = $request->input('date_to');
        $event->img = '';
        $event->save();

        return redirect('/events')->with('success', 'Akce byla úspěšně přidána!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        return view('events.show')->with('event',$event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $request->user()->authorizeRoles(['administrator', 'manager']);
        $event = Event::find($id);
        return view('events.edit')->with('event',$event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->user()->authorizeRoles(['administrator', 'manager']);
        $this->validate($request, [
            'name' => 'required|max:60',
            'description' => 'required',
            'date_from' => 'required|date_format:Y-m-d',
            'date_to' => 'required|date_format:Y-m-d|after_or_equal:date_from'
        ]);

        $event = Event::find($id);
        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->date_from = $request->input('date_from');
        $event->date_to = $request->input('date_to');
        $event->save();

        return redirect('/events')->with('success', 'Akce byla úspěšně upravena!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $request->user()->authorizeRoles(['administrator', 'manager']);
        $event = Event::find($id);
        $event->delete();
        return redirect('/events')->with('success', 'Akce byla odstraněna!');
    }
}
