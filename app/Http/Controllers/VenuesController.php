<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venue;
use DB;

class VenuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('venues.livesearch');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('venues.create');
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
            'name' => 'required|unique:venues|max:80',
            'description' => 'required',
            'street' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'lat' => 'required',
            'long' => 'required'
        ]);

        $venue = new Venue;
        $venue->name = $request->input('name');
        $venue->description = $request->input('description');
        $venue->street = $request->input('street');
        $venue->city = $request->input('city');
        $venue->zip = $request->input('zip');
        $venue->country = $request->input('country');
        $venue->lat = $request->input('lat');
        $venue->long = $request->input('long');

        $venue->save();

        //return redirect('/events')->with('success', 'Místo konání bylo úspěšně přidáno!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('venues')
        ->where('name', 'LIKE', "%{$query}%")
        ->get();
      $output = '<ul class="dropdown-menu w-100" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '
       <li class="pl-2 pr-2"><a href="#">'.$row->name.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }
}