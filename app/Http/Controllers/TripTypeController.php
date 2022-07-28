<?php

namespace App\Http\Controllers;

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
        return view('trip_types.index',[
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
        return view('trip_types.create');
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
            'name'=> 'required', 
        ]);

        TripType::create($request->all());

        return redirect()->route('trip_types.index')->with('success','Trip Type has been created successfully.');

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
    public function edit(TripType $trip_type)
    {
        return view('trip_types.edit', compact('trip_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  TripType $trip_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TripType $trip_type)
    {
        if($trip_type)
        {
        $trip_type->update([
            'name' => $request->name ? $request->name : $trip_type->name,
        ]);
        
        $trip_type ->save();
        }

        return redirect()->route ('trip_types.index')->with('success','Trip Type Has Been updated successfully');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TripType $trip_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(TripType $trip_type)
    {
        $trip_type->delete();
    
        return redirect()->route('trip_types.index')->with('success','Trip Type has been deleted successfully');

    }
}
