<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripTypeFormRequest;
use App\Models\Trip;
use App\Models\TripType;
use Illuminate\Http\Request;

class TripTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.trip_types.index',[
            'trip_types' => TripType::latest()->paginate(10)
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.trip_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TripTypeFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TripTypeFormRequest $request)
    {
        $validated = $request->validated();
        TripType::create($validated);

        return redirect()->route('settings.trip_types.index')->with('success','Trip Type has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  TripType $trip_type
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  TripType $trip_type
     * @return \Illuminate\Http\Response
     */
    public function edit(TripType $trip_type)
    {
        return view('settings.trip_types.edit', compact('trip_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TripTypeFormRequest  $request
     * @param  TripType $trip_type
     * @return \Illuminate\Http\Response
     */
    public function update(TripTypeFormRequest $request, TripType $trip_type)
    {
        $validated = $request->validated();
        
        if($trip_type){
            $trip_type->update($validated);
            $trip_type->save();
        }
        return redirect()->route ('settings.trip_types.index')->with('success','Trip Type Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trip_type = TripType::findOrFail($id);
        $trip_type->delete();  
        return response()->json([
            'success' => true,
        ]);    
    }
}
