<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use Illuminate\Http\Request;

class AccomodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accomodations.index',[
            'accomodations' => Accomodation::latest()->paginate(10)
        ]);     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accomodations.create');    
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

        Accomodation::create($request->all());

        return redirect()->route('accomodations.index')->with('success','Accomodation has been created successfully.');
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
    public function edit(Accomodation $accomodation)
    {
        return view('accomodations.edit', compact('accomodation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accomodation $accomodation)
    {
        if($accomodation)
        {
        $accomodation->update([
            'name' => $request->name ? $request->name : $accomodation->name,
        ]);
        
        $accomodation ->save();
        }

        return redirect()->route ('accomodations.index')->with('success','Accomodation Has Been updated successfully');
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accomodation $accomodation)
    {
        $accomodation->delete();
    
        return redirect()->route('accomodations.index')->with('success','Accomodation has been deleted successfully');
    }
}
