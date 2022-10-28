<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Activity;
use App\Models\ActivityFile;
use Illuminate\Http\Request;
use App\Http\Requests\ActivityFileRequest;

class ActivityFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityFileRequest $request)
    {
        $this->authorize('store.activities',Activity::class);
        $validated = $request->validated();
        $validated['is_done'] = $validated['type'] == 'file' ? 1 : 0;
        $activity = Activity::create($validated);
        $lead = Lead::findOrFail($validated['lead_id']);
        $lead->activities()->attach($activity);
        $validated['activity_id'] = $activity->id;
        $validated['name'] = $validated['title'];
        $file = ActivityFile::create($validated);
        
        if($request->activity_file == true){
            $file->addMedia($request->activity_file)
                ->preservingOriginal()
                ->toMediaCollection('activity_file');
        }

        return back()->with('success','File has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityFile  $activityFile
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityFile $activityFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityFile  $activityFile
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityFile $activityFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActivityFile  $activityFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivityFile $activityFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityFile  $activityFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityFile $activityFile)
    {
        //
    }
}
