<?php

namespace App\Http\Controllers;

use App\Models\LeadType;
use Illuminate\Http\Request;
use App\Http\Requests\LeadTypeFormRequest;

class LeadTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.lead_types.index',[
            'lead_types' => LeadType::latest()->paginate(10)
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.lead_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LeadTypeFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeadTypeFormRequest $request)
    {
        $validated = $request->validated();
        LeadType::create($validated);

        return redirect()->route('settings.lead_types.index')->with('success','Lead Type has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param LeadType $leadtype
     * @return \Illuminate\Http\Response
     */
    public function show(LeadType $lead_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  LeadType $lead_type
     * @return \Illuminate\Http\Response
     */
    public function edit(LeadType $lead_type)
    {
        return view('settings.lead_types.edit', compact('lead_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LeadTypeFormRequest  $request
     * @param  int  LeadType $lead_type
     * @return \Illuminate\Http\Response
     */
    public function update(LeadTypeFormRequest $request, LeadType $lead_type)
    {
        $validated = $request->validated();
        
        if($lead_type){
            $lead_type->update($validated);
            $lead_type->save();
        }
        return redirect()->route ('settings.lead_types.index')->with('success','Lead Type Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lead_type = LeadType::findOrFail($id);
        $lead_type->delete();  
        return response()->json([
            'success' => true,
        ]);    
    }

}
