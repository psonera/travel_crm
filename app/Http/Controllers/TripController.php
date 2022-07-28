<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trips.index',[
            'trips' => Trip::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required', 
            'description'=> 'required', 
            'location'=> 'required', 
            'start_date'=> 'required', 
            'end_date'=> 'required', 
            'batch_size'=> 'required',
            'price'=> 'required',
            'trip_type_id'=> 'required',
        ]);
        
        $trip = Trip::create($request->all());

        return redirect()->route('trips.index')->with('Trip created successfully');
        
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
     * @param  Trip $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    { 
        return view('trips.edit', compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Trip $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {   
        if($trip)
        {
        $trip->update([
            'name' => $request->name ? $request->name : $trip->name,
            'title'=> $request->title ? $request->title : $trip->title, 
            'description'=> $request->description ? $request->description : $trip->description, 
            'location'=> $request->location ? $request->location : $trip->location, 
            'start_date'=> $request->start_date ? $request->start_date : $trip->start_date, 
            'end_date'=> $request->end_date ? $request->end_date : $trip->end_date, 
            'batch_size'=> $request->batch_size ? $request->batch_size : $trip->batch_size,
            'price'=> $request->price ? $request->price : $trip->price,
            'trip_type_id'=> $request->trip_type_id ? $request->trip_type_id : $trip->trip_type_id,
        ]);
        
            $trip->save();
        }

        return redirect()->route ('trips.index')->with('success','Trip has been updated successfully.');;
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trip = Trip::find($id);
        $trip->delete();
    
        return redirect()->route('trips.index');
    }
}
