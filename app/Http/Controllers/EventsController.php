<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Event;
use App\Event_category;
use App\Venue;
use App\Ticket;

class EventsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show','index_past','index_upcoming']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentEvents = Event::orderBy('date_to','asc')->where('date_to', '>=', now()->format('Y-m-d'))->where('date_from', '<=', now()->format('Y-m-d'))->get();
        $upcomingEvents = Event::orderBy('date_from','asc')->where('date_from', '>', now()->format('Y-m-d'))->take(10)->get();
        return view('events.index')->with(['currentEvents' => $currentEvents, 'upcomingEvents' => $upcomingEvents]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_past()
    {
        $pastEvents = Event::orderBy('date_to','desc')->where('date_to', '<', now()->format('Y-m-d'))->paginate(9);
        return view('events.index_past')->with('pastEvents', $pastEvents);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_upcoming()
    {
        $upcomingEvents = Event::orderBy('date_from','asc')->where('date_from', '>', now()->format('Y-m-d'))->paginate(9);
        return view('events.index_upcoming')->with('upcomingEvents', $upcomingEvents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['administrator', 'manager']);
        return view('events.create')->with(['categories'=> $this->getAllCategories(), 'checked_categories'=> collect()]);
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
            'date_to' => 'required|date_format:Y-m-d|after_or_equal:date_from',
            'venue_name_livesearch' => 'required|exists:venues,name',
            'img' => 'image|nullable|max:1999',
            'ticket.*.name' => 'required',
            'ticket.*.price' => 'required|numeric|between:0,99999',
        ]);
        //Handle file upload
        if($request->hasFile('img')){
            //Get filename with the extension
            $filenamewithExt = $request->file('img')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);        
            //Get just ext
            $extension = $request->file('img')->guessClientExtension();        
            //FileName to store
            $fileNameToStore = time().'.'.$extension;            
            //Upload Image
            $path = $request->file('img')->storeAs('public/cover_images/',$fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }


        // Create Event
        $venue_id = Venue::where('name', ($request->input('venue_name_livesearch')))->first()->id;

        $event = new Event;
        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->date_from = $request->input('date_from');
        $event->date_to = $request->input('date_to');
        $event->venue_id = $venue_id;
        $event->img = $fileNameToStore;
        $event->user_id = auth()->user()->id;
        $event->save();
        

        $id = $event->id;

        //Categories
        $categories_checkbox = $request->get('category');
        Event::find($id)->event_category()->sync($categories_checkbox);

        //Tickets
        if ($request->ticket){
            foreach ($request->ticket as $value) {
                $ticket =  new Ticket;
                $ticket->name = $value['name'];
                $ticket->price = $value['price'];
                $ticket->event_id = $id;
                $ticket->save();
            }
        }

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
        $venue_name = "";

        if ($event->venue) {
            $venue_name = $event->venue->name;
        }

        if (auth()->user()->id == $event->user_id || auth()->user()->hasRole('administrator')){
            return view('events.edit')->with(['event' => $event, 'venue_name' => $venue_name, 'categories'=> $this->getAllCategories(), 'checked_categories'=> $this->getCheckedCategories($id)]);
        }
        else {
            return abort(401);
        }
        

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
            'name' => 'required|max:80',
            'description' => 'required',
            'date_from' => 'required|date_format:Y-m-d',
            'date_to' => 'required|date_format:Y-m-d|after_or_equal:date_from',
            'venue_name_livesearch' => 'required|exists:venues,name',
            'img' => 'image|nullable|max:1999'
        ]);

        //Handle file upload
        if($request->hasFile('img')){
            //Get filename with the extension
            $filenamewithExt = $request->file('img')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);        
            //Get just ext
            $extension = $request->file('img')->guessClientExtension();        
            //FileName to store
            $fileNameToStore = time().'.'.$extension;            
            //Upload Image
            $path = $request->file('img')->storeAs('public/cover_images/',$fileNameToStore);
        }

  


        //Update event
        $venue_id = Venue::where('name', ($request->input('venue_name_livesearch')))->first()->id;

        $event = Event::find($id);


        //Delete image if changed
        if($request->hasFile('cover_image')){
            if($event->cover_image != 'noimage.jpg') {
                Storage::delete('public/cover_images/' . $event->cover_image);
            }
            $event->cover_image = $fileNameToStore;
        }

        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->date_from = $request->input('date_from');
        $event->date_to = $request->input('date_to');
        $event->venue_id = $venue_id;



        if($request->hasFile('img')){
            if($event->img != 'noimage.jpg'){
                Storage::delete('public/cover_images/'.$event->img);
            }
            $event->img = $fileNameToStore;
        }

        $event->save();

        //Categories
        $categories_checkbox = $request->get('category');
        Event::find($id)->event_category()->sync($categories_checkbox);

        //Tickets
        $event->ticket()->delete();
        if ($request->ticket){
            foreach ($request->ticket as $value) { 
                
                $ticket =  new Ticket;
                $ticket->name = $value['name'];
                $ticket->price = $value['price'];
                $ticket->event_id = $id;
                $ticket->save();
            }
        }

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


        if (auth()->user()->id == $event->user_id || auth()->user()->hasRole('administrator')){
            //Delete image
            if($event->img != 'noimage.jpg'){
                Storage::delete('public/cover_images/'.$event->img);
            }

            $event->delete();
            return redirect('/home/events')->with('success', 'Akce byla odstraněna!');
        }
        else {
            return abort(401);
        }




    }

    /**
    * Display a listing of the event categories.
    *
    * @return \Illuminate\Http\Response
    */
   public function getAllCategories()
   {
       $categories = Event_category::all();
       return $categories;
   }

    /**
    * Display a listing of the checked event categories.
    *
    * @return \Illuminate\Http\Response
    */
    public function getCheckedCategories($event_id)
    {
        $checkedCategories = Event::find($event_id)->event_category;
        return $checkedCategories;
    }

}
