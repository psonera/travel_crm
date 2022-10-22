<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccomodationFormRequest;
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
        return view('settings.accomodations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.accomodations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AccomodationFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccomodationFormRequest $request)
    {
        $validated = $request->validated();

        Accomodation::create($validated);

        return redirect()->route('settings.accomodations.index')->with('success', 'Accomodation has been created successfully.');
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
     * @param  Accomodation $accomodation
     * @return \Illuminate\Http\Response
     */
    public function edit(Accomodation $accomodation)
    {
        return view('settings.accomodations.edit', compact('accomodation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AccomodationFormRequest  $request
     * @param  Accomodation $accomodation
     * @return \Illuminate\Http\Response
     */
    public function update(AccomodationFormRequest $request, Accomodation $accomodation)
    {
        $validated = $request->validated();
        
        if($accomodation){
            $accomodation->update($validated);
            $accomodation->save();
        }
        return redirect()->route('settings.accomodations.index')->with('success', 'Accomodation Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $accomodation = Accomodation::findOrFail($request->id);
        $accomodation->delete();  
        return response()->json([
            'success' => 'Accomodation Deleted Successfully!',
        ]);
    }

    public function get(){
        return response()->json([
            'accomodations' => Accomodation::all()->toArray(),
        ]);
    }
}
