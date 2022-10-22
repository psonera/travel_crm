<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Requests\TripFormRequest;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.trips.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.trips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TripFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TripFormRequest $request)
    {
        $validated = $request->validated();
        Trip::create($validated);

        return redirect()->route('settings.trips.index')->with('success','Trip created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  Trip $trip
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
        return view('settings.trips.edit', compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TripFormRequest  $request
     * @param  Trip $trip
     * @return \Illuminate\Http\Response
     */
    public function update(TripFormRequest $request, Trip $trip)
    {   
        $validated = $request->validated();
        if($trip){
            $trip->update($validated);
            $trip->save();
        }
        return redirect()->route('settings.trips.index')->with('success','Trip has been updated successfully!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();  
        return response()->json([
            'success' => 'Trip Deleted Successfully!',
        ]);
    }

    public function get(){
        return response()->json([
            'trips' => Trip::all()->toArray(),
        ]);
    }
}
