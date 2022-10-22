<?php

namespace App\Http\Controllers;

use App\Models\LeadPipeline;
use Illuminate\Http\Request;
use App\Http\Requests\LeadPipelineFormRequest;
use App\Models\LeadPipelineStage;
use App\Models\LeadStage;

class LeadPipelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('lead pipelines',LeadPipeline::class);
        return view('settings.lead_pipelines.index',[
            'lead_pipelines' => LeadPipeline::latest()->paginate(50)
        ]);
    }

    public function allpipeline(){
        $pipeline = LeadPipeline::all();
        return response()->json($pipeline);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create.lead pipelines',LeadPipeline::class);
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
        // $this->authorize('store.lead pipelines',LeadPipeline::class);
        $pipeline = LeadPipeline::create([
            "name"=>$request->name,
            "is_default"=>$request->is_default,
            'rotten_days'=>$request->rotten_days
        ]);
        $stages_names = $request->stagename;
        $stage_prob = $request->stageper;
        $objs = [];

        $length = count($stages_names);
        $k = 1;
        for ($i=0; $i < $length; $i++) {
            $lead_stage = new LeadPipelineStage();
            $lead_stage->code = $stages_names[$i];
            $lead_stage->name = $stages_names[$i];
            $lead_stage->probability = $stage_prob[$i];
            $lead_stage->sort_order = $k;
            $k++;
            array_push($objs,$lead_stage);
        }
        $pipeline->leadStages()->saveMany($objs);
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
        // $this->authorize('view.lead pipelines',LeadPipeline::class);
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
        // $this->authorize('update.lead pipelines',LeadPipeline::class);
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

        $lead_pipeline->name =$request->name;
        $lead_pipeline->is_default = $request->is_default;
        $lead_pipeline->rotten_days = $request->rotten_days;
        $lead_pipeline->save();

        //delete old stages

        $lead_pipeline->leadStages()->delete();

        $stages_names = $request->stagename;
        $stage_prob = $request->stageper;
        $objs = [];

        $length = count($stages_names);
        $k = 1;
        for ($i=0; $i < $length; $i++) {
            $lead_stage = new LeadPipelineStage();
            $lead_stage->code = $stages_names[$i];
            $lead_stage->name = $stages_names[$i];
            $lead_stage->probability = $stage_prob[$i];
            $lead_stage->sort_order = $k;
            $k++;
            array_push($objs,$lead_stage);
        }
        $lead_pipeline->leadStages()->saveMany($objs);

        return redirect()->route ('settings.lead_pipelines.index')->with('success','Lead Pipeline Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LeadPipeline $lead_pipeline
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeadPipeline $lead_pipeline)
    {
        // $this->authorize('delete.lead pipelines',LeadPipeline::class);

        $lead_pipeline->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}
