<?php

namespace App\Http\Controllers;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required', 
            'email'=> 'required|email', 
            'contact_number'=> 'required|max:10', 
            'lead_source_id'=> 'required', 
        ]);
        
        $lead_manager = LeadManager::create($request->all());
        
        $lead_manager->assignRole('Lead Manager');
        
        return redirect()->route('lead_managers.index')->with('success','Lead Manager has been created successfully.');
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
    public function edit($id)
    {
        $lead_manager = LeadManager::find($id);
        return view('lead_managers.edit', compact('lead_manager'));      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lead_manager = LeadManager::find($id);
        
        if($lead_manager)
        {
        $lead_manager->update([
            'name' => $request->name ? $request->name : $lead_manager->name,
            'email' => $request->email ? $request->email : $lead_manager->email,
            'contact_number' => $request->contact_number ? $request->contact_number : $lead_manager->contact_number,
            'lead_source_id' => $request->lead_source_id ? $request->lead_source_id : $lead_manager->lead_source_id,
        ]);
        
        $lead_manager ->save();
        }

        return redirect()->route('lead_managers.index')->with('success','Lead Manager Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lead_manager = LeadManager::find($id);
        $lead_manager->delete();
    
        return redirect()->route('lead_managers.index')->with('success','Lead Manager has been deleted successfully');
    }
}
