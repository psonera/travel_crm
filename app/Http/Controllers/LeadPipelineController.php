<?php

namespace App\Http\Controllers;

use App\Models\LeadPipeline;
use Illuminate\Http\Request;

class LeadPipelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.lead_pipelines.index',[
            'lead_pipelines' => LeadPipeline::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('settings.lead_pipelines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->is_default);
        LeadPipeline::create([
            'name' => $request->name,
            'is_default' => $request->is_default,
            'rotten_days' => $request->rotten_days,
        ]);
        
        return redirect()->route('settings.lead_pipelines.index')->with('success','Lead Pipeline has been created successfully.');

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
    public function edit(LeadPipeline $lead_pipeline)
    {
        return view('settings.lead_pipelines.edit', compact('lead_pipeline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeadPipeline $lead_pipeline)
    {
        if($lead_pipeline)
        {
        $lead_pipeline->update([
            'name' => $request->name ? $request->name : $lead_pipeline->name,
            'is_default' => $request->is_default ? $request->is_default : $lead_pipeline->is_default,
            'rotten_days' => $request->rotten_days ? $request->rotten_days : $lead_pipeline->rotten_days,
            
        ]);
        
        $lead_pipeline ->save();
        }

        return redirect()->route ('settings.lead_pipelines.index')->with('success','Lead Pipeline Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeadPipeline $lead_pipeline)
    {
        $lead_pipeline->delete();
    
        return redirect()->route('settings.lead_pipelines.index')->with('success','Lead Pipeline has been deleted successfully');
    }
}
