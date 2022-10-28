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
        $this->authorize('trips', Trip::class);
        return view('settings.trips.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create.trips', Trip::class);
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
        $this->authorize('store.trips', Trip::class);
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
        $this->authorize('update.trips', Trip::class);
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
        $this->authorize('update.trips', Trip::class);
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
        $this->authorize('delete.trips', Trip::class);
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
