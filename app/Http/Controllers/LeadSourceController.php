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
        $this->authorize('lead-sources',LeadSource::class);
        return view('settings.lead_sources.index',[
            'lead_sources' => LeadSource::latest()->paginate(10)
        ]);
    }

    public function allleadsources(){
        $leadsource = LeadSource::all();
        return response()->json($leadsource);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create.lead-sources',LeadSource::class);
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
        $this->authorize('store.lead-sources',LeadSource::class);
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
        // $this->authorize('view.lead sources',LeadSource::class);
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
        $this->authorize('update.lead-sources',LeadSource::class);
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
        $this->authorize('update.lead-sources',LeadSource::class);
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
     * @param  LeadSource $lead_source
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeadSource $lead_source)
    {
        $this->authorize('delete.lead-sources',LeadSource::class);
        $lead_source->delete();
        return response()->json([
            'success' => 'Lead Source has been deleted successfully.',
        ]);    
    }
}
