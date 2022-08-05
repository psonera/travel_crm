<?php

namespace App\Http\Controllers;

use App\Models\LeadSource;
use Illuminate\Http\Request;
use App\Http\Requests\LeadSourceFormRequest;

class LeadSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.lead_sources.index',[
            'lead_sources' => LeadSource::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.lead_sources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LeadSourceFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeadSourceFormRequest $request)
    { 
         $validated = $request->validated();
        LeadSource::create($validated);

        return redirect()->route('settings.lead_sources.index')->with('success','Lead Sources has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  LeadSource $lead_source
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LeadSource $lead_source
     * @return \Illuminate\Http\Response
     */
    public function edit(LeadSource $lead_source)
    {
        return view('settings.lead_sources.edit', compact('lead_source'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LeadSourceFormRequest $request
     * @param  LeadSource $lead_source
     * @return \Illuminate\Http\Response
     */
    public function update(LeadSourceFormRequest $request, LeadSource $lead_source)
    {
        $validated = $request->validated();
        
        if($lead_source){
            $lead_source->update($validated);
            $lead_source->save();
        }
        return redirect()->route ('settings.lead_sources.index')->with('success','Lead Source Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lead_source->delete();
        return redirect()->route('settings.lead_sources.index')->with('success','Lead Source has been deleted successfully');
    }
}
