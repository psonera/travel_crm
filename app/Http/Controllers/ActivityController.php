<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\Activity;
use App\Models\ActivityFile;
use Illuminate\Http\Request;
use App\Events\ActivityCreated;
use App\Events\ActivityModified;
use App\Models\ActivityParticipant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ActivityFormRequest;
use Spatie\MediaLibrary\Support\MediaStream;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('activities',Activity::class);
        return view('activities.index', [
            'activities' => Activity::latest()->paginate(10)
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create.activities',Activity::class);
        return view('activities.create');
    }

    public function find_user(Request $request)
    {
        $active_users = User::where('status', '1')->get();

        $request->validate([
            'search_user' => 'string',
            'user_id' => 'numeric',
            'type' => 'numeric'
        ]);
        $search_user = $request->search_user;
        $user_id = $request->user_id;
        $type = $request->type;
        $all_users = $active_users;
        $all_users = array();

        if($type == 1){
            $all_users = User::where('name', 'like', '%'.$search_user.'%')->get();

            return response()->json($all_users);
        }

        if($type == 2){
            $user = User::where('id', $user_id)->first();

            return response()->json($user);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ActivityFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityFormRequest $request)
    {
        $this->authorize('store.activities',Activity::class);
        $validated = $request->validated();

        $validated['is_done'] = $validated['type'] == 'note' ? 1 : 0;
        $validated['user_id'] = Auth::user()->id;
        $lead = Lead::findOrFail($validated['lead_id']);

        $activity = Activity::create($validated);

        if (request('participants')) {

            if (is_array(request('participants.users'))) {
                foreach (request('participants.users') as $userId) {
                    $activity->activityParticipants()->create([
                        'user_id' => $userId
                    ]);
                }
            }

            if (is_array(request('participants.lead_managers'))) {
                foreach (request('participants.lead_managers') as $leadmanagerId) {
                    $activity->activityParticipants()->create([
                        'lead_manager_id' => $leadmanagerId,
                    ]);
                }
            }
        }

        $lead->activities()->attach($activity);

        $event_data = array();
        $event_data['activity'] = $activity;
        $event_data['lead_name'] = $lead->title; 

        ActivityCreated::dispatch($event_data);

        if($activity){
            session()->flash('success', 'Activity has been created successfully.');
            return redirect()->back();
        } else {
            session()->flash('error', 'Activity could not created successfully. Try again later!');
            return redirect()->back();
        }
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
     * @param  Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        $this->authorize('update.activities',Activity::class);
        return view('activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ActivityFormRequest  $request
     * @param  Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityFormRequest $request, Activity $activity)
    {
        $this->authorize('update.activities',Activity::class);
        $validated = $request->validated();
        
        if($activity){
            if (request('participants')) {
                $activity->activityParticipants()->delete();
    
                if (is_array(request('participants.users'))) {
                    foreach (request('participants.users') as $userId) {
                        $activity->activityParticipants()->create([
                            'user_id' => $userId
                        ]);
                    }
                }
    
                if (is_array(request('participants.lead_managers'))) {
                    foreach (request('participants.lead_managers') as $leadmanagerId) {
                        $activity->activityParticipants()->create([
                            'lead_manager_id' => $leadmanagerId,
                        ]);
                    }
                }
            }
            $activity->update($validated);
            $activity->save();

            $event_data = array();
            $event_data['activity'] = $activity;
            $event_data['lead_name'] = $activity->leads[0]->title; 

            ActivityModified::dispatch($event_data);
        }
        return back()->with('success', 'Activity Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete.activities',Activity::class);
        $activity = Activity::findOrFail($id);
        $activity->delete();  
        return back()->with('success', 'Activity deleted successfully!');
    }

    public function download($id)
    {
        $file = ActivityFile::findOrFail($id);
        $media = $file->getMedia('activity_file');
        return MediaStream::create($media[0]->file_name)->addMedia($media);
    }

    public function mark_as_done($id){
        $this->authorize('update.activities',Activity::class);
        $activity = Activity::findOrFail($id);
        $activity->is_done = 1;
        $activity->save();

        return back()->with('success', 'Activity marked done successfully!');
    }
}
