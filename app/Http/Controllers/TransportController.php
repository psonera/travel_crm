<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Http\Request;
use App\Http\Requests\TransportFormRequest;

class TransportController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('transports', Transport::class);
        return view('settings.transports.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create.transports', Transport::class);
        return view('settings.transports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TransportFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransportFormRequest $request)
    {
        $this->authorize('store.transports', Transport::class);
        $validated = $request->validated();
        Transport::create($validated);

        return redirect()->route('settings.transports.index')->with('success','Transport has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function edit(Transport $transport)
    {
        $this->authorize('update.transports', Transport::class);
        return view('settings.transports.edit', compact('transport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TransportFormRequest  $request
     * @param  Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function update(TransportFormRequest $request, Transport $transport)
    {
        $this->authorize('update.transports', Transport::class);
        $validated = $request->validated();
        
        if($transport){
            $transport->update($validated);
            $transport->save();
        }
        return redirect()->route('settings.transports.index')->with('success','Transport Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->authorize('delete.transports', Transport::class);
        $transport = Transport::findOrFail($request->id);
        $transport->delete();  
        return response()->json([
            'success' => 'Transport Deleted Successfully!',
        ]);    
    }

}
