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
        // $this->authorize('lead-types',LeadType::class);
        return view('settings.lead_types.index',[
            'lead_types' => LeadType::latest()->paginate(10)
        ]);
    }


    public function allleadtype(){
        $leadtype = LeadType::all();
        return response()->json($leadtype);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create.lead-types',LeadType::class);
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
        // $this->authorize('store.lead-types',LeadType::class);
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
        // $this->authorize('view.lead-types',LeadType::class);
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
        // $this->authorize('update.lead-types',LeadType::class);
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
        return redirect()->route('settings.lead_types.index')->with('success','Lead Type Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LeadType $lead_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeadType $lead_type)
    {
        $this->authorize('delete.lead-types',LeadType::class);
        $lead_type->delete();
        return back()->with('success','Lead Pipeline Stage has been deleted successfully!');
    }

}
