<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeadManagerFormRequest;
use App\Models\LeadManager;
use Illuminate\Http\Request;

class LeadManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lead_managers.index',[
            'lead_managers' => LeadManager::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lead_managers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LeadManagerFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeadManagerFormRequest $request)
    {
        $validated = $request->validated();
        
        $lead_manager = LeadManager::create($validated);
        
        $lead_manager->assignRole('Lead Manager');
        
        return redirect()->route('lead_managers.index')->with('success','Lead Manager has been created successfully.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  LeadManager  $lead_manager
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LeadManager  $lead_manager
     * @return \Illuminate\Http\Response
     */
    public function edit(LeadManager $lead_manager)
    {
        return view('lead_managers.edit', compact('lead_manager'));      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LeadManagerFormRequest  $request
     * @param  LeadManager  $lead_manager
     * @return \Illuminate\Http\Response
     */
    public function update(LeadManagerFormRequest $request, LeadManager $lead_manager)
    {        
        $validated = $request->validated();
        
        if($lead_manager){
            $lead_manager->update($validated);
            $lead_manager->save();
        }
        return redirect()->route ('lead_managers.index')->with('success','Lead Manager has been updated successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LeadManager  $lead_manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeadManager  $lead_manager)
    {
        $lead_manager->delete();    
        return redirect()->route('lead_managers.index');
    }
}
