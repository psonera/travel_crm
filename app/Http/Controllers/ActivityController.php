<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Requests\ActivityFormRequest;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $validated = $request->validated();

        Activity::create($validated);

        return redirect()->route('activities.index')->with('success', 'Activity has been created successfully.');
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
        $validated = $request->validated();
        
        if($activity){
            $activity->update($validated);
            $activity->save();
        }
        return redirect()->route('activities.index')->with('success', 'Activity Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();  
        return response()->json([
            'success' => true,
        ]);

    }
}
