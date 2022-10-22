<?php

namespace App\Http\Controllers;

use App\Models\LeadPipelineStage;
use Illuminate\Http\Request;

class LeadPipelineStageController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('lead-pipeline-stages',LeadPipelineStage::class);
        return view('settings.lead_pipeline_stages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create.lead-pipeline-stages',LeadPipelineStage::class);
        return view('settings.lead_pipeline_stages.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LeadPipelineStage $lead_pipeline_stage
     * @return \Illuminate\Http\Response
     */
    public function edit(LeadPipelineStage $lead_pipeline_stage)
    {
        $this->authorize('update.lead-pipeline-stages',LeadPipelineStage::class);
        return view('settings.lead_pipeline_stages.edit', compact('lead_pipeline_stage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('store.lead-pipeline-stages',LeadPipelineStage::class);
        $validated = $request->validate([
            'code' => 'string|max:20',
            'name' => 'string|max:20',
            'probability' => 'required|numeric',
            'sort_order' => 'required|numeric'
        ]);
        LeadPipelineStage::create($validated);

        return redirect()->route('settings.lead_pipeline_stages.index')->with('success','Lead Pipeline Stage has been created successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  LeadPipelineStage $lead_pipeline_stage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeadPipelineStage $lead_pipeline_stage)
    {
        $this->authorize('update.lead-pipeline-stages',LeadPipelineStage::class);
        $validated = $request->validate([
            'code' => 'string|max:20',
            'name' => 'string|max:20',
            'probability' => 'required|numeric',
            'sort_order' => 'required|numeric'
        ]);

        $lead_pipeline_stage->update($validated);

        return redirect()->route('settings.lead_pipeline_stages.index')->with('success','Lead Pipeline Stage has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LeadPipelineStage $lead_pipeline_stage
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeadPipelineStage $lead_pipeline_stage)
    {
        $this->authorize('delete.lead-pipeline-stages',LeadPipelineStage::class);
        if($lead_pipeline_stage->code == 'new' || $lead_pipeline_stage->code == 'won' || $lead_pipeline_stage->code == 'lost'){
            return redirect()->route('settings.lead_pipeline_stages.index')->with('error', 'You can not delete "'.$lead_pipeline_stage->name.'" stage!');
        }
        $lead_pipeline_stage->delete();
        return redirect()->route('settings.lead_pipeline_stages.index')->with('success','Lead Pipeline Stage has been deleted successfully!');
    }
}
