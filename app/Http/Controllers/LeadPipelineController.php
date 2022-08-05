<?php

namespace App\Http\Controllers;

use App\Models\LeadPipeline;
use Illuminate\Http\Request;
use App\Http\Requests\LeadPipelineFormRequest;

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
            'lead_pipelines' => LeadPipeline::latest()->paginate(50)
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
     * @param  LeadPipelineFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeadPipelineFormRequest $request)
    {
        $validated = $request->validated();
      
        LeadPipeline::create($validated);

        return redirect()->route('settings.lead_pipelines.index')->with('success','Lead Pipeline has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  LeadPipeline $lead_pipeline
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LeadPipeline $lead_pipeline
     * @return \Illuminate\Http\Response
     */
    public function edit(LeadPipeline $lead_pipeline)
    {
        return view('settings.lead_pipelines.edit', compact('lead_pipeline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LeadPipelineFormRequest  $request
     * @param  LeadPipeline $lead_pipeline
     * @return \Illuminate\Http\Response
     */
    public function update(LeadPipelineFormRequest $request, LeadPipeline $lead_pipeline)
    {
        $validated = $request->validated();
        
        if($lead_pipeline){
            $lead_pipeline->update($validated);
            $lead_pipeline->save();
        }
        return redirect()->route ('settings.lead_pipelines.index')->with('success','Lead Pipeline Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lead_pipeline = LeadPipeline::findOrFail($id);
        $lead_pipeline->delete();  
        return response()->json([
            'success' => true,
        ]);
    }
}
