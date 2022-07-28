<?php

namespace App\Http\Controllers;

use App\Models\LeadType;
use Illuminate\Http\Request;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required', 
        ]);

        LeadType::create($request->all());

        return redirect()->route('settings.lead_types.index')->with('success','Lead Type has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  LeadType $leadtype
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  LeadType $lead_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeadType $lead_type)
    {
        if($lead_type)
        {
        $lead_type->update([
            'name' => $request->name ? $request->name : $lead_type->name,
        ]);
        
        $lead_type ->save();
        }

        return redirect()->route ('settings.lead_types.index')->with('success','Lead Type Has Been updated successfully');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  LeadType $lead_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeadType $lead_type)
    {
        $lead_type->delete();
    
        return redirect()->route('lead_type.index')->with('success','Lead Type has been deleted successfully');
    }
}
