<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\LeadSource;
use App\Models\LeadManager;
use Illuminate\Http\Request;
use App\Events\TransferOfLeads;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LeadManagerFormRequest;

class LeadManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('lead-managers',LeadManager::class);
        return view('lead_managers.index',[
            'lead_managers' => LeadManager::where('is_lead_manager','1')->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create.lead-managers',LeadManager::class);
        $leadsources = LeadSource::all();
        return view('lead_managers.create',['leadsources'=>$leadsources]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LeadManagerFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeadManagerFormRequest $request)
    {

        $this->authorize('store.lead-managers',LeadManager::class);


        $user = LeadManager::create([
            'name'=>$request->name,
            "created_by"=>auth()->user()->id,
            "email"=>$request->email,
            "phone_number" => $request->phone,
            "password"=>Hash::make($request->password),
            "is_lead_manager"=> 1,
            "lead_source_id" => $request->leadsource,
            "authorize_person"=>$request->has('manager') ? $request->r_manager :auth()->user()->id,
            "status" => $request->status
        ]);

        $actualuser = User::where('id',$user->id)->first();
        $role = Role::where('name','lead-manager')->get()->first();
        $actualuser->syncRoles([$role]);
        if($request->has('profile_image')){
            $actual_user = User::find($user->id);
            $actual_user->addMedia($request->profile_image)
                ->preservingOriginal()
                ->toMediaCollection('media','media_file');
        }

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
        // $this->authorize('view.lead managers',LeadManager::class);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LeadManager  $lead_manager
     * @return \Illuminate\Http\Response
     */
    public function edit(LeadManager $lead_manager)
    {
        $this->authorize('update.lead-managers',LeadManager::class);
        $leadsources = LeadSource::all();
        return view('lead_managers.edit', ['lead_manager'=>$lead_manager,'leadsources'=>$leadsources]);
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
        $user=$lead_manager;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone;
        $user->password = Hash::make($request->password);
        $user->is_lead_manager = 1;
        $user->lead_source_id =  $request->leadsource;
        $user->authorize_person = $request->has('manager') ? $request->r_manager :auth()->user()->id;
        $user->status = $request->status;
        // $role_of_user = auth()->user()->roles[0]->first();
        // dd($role_of_user->hasPermissionTo('update.lead-managers'));
        $user->save();
        $actualuser = User::where('id',$lead_manager->id)->first();
        $role = Role::where('name','lead-manager')->get()->first();
        $actualuser->syncRoles([$role]);
        if($request->has('profile_image')){
            //delete
            // $actualuser = User::where('id',$lead_manager->id)->first();
            if(count($actualuser->getMedia('media')) > 0){
                foreach($actualuser->getMedia('media') as $media){
                    $media->delete();
                }
           }
            $actualuser->addMedia($request->profile_image)
                ->preservingOriginal()
                ->toMediaCollection('media','media_file');
        }
        return redirect()->route ('lead_managers.index')->with('success','Lead Manager has been updated successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LeadManager $lead_manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeadManager $lead_manager)
    {
        $this->authorize('delete.lead-managers',LeadManager::class);
        $all_leads = Lead::where('lead_manager_id',$lead_manager->id)->get();
        $manager = User::where('authorize_person',$lead_manager->authorize_person)->first();

         if(count($all_leads) > 0){
            foreach($all_leads as $lead){
                $lead->lead_manager_id = $manager->id;
                $lead->save();
            }
            $data['lead_manager'] = $lead_manager;
            $data['new_manager'] = $manager;
            TransferOfLeads::dispatch($data);
        }
        if(count($lead_manager->getMedia('media')) > 0){
            foreach($lead_manager->getMedia('media') as $media){
                $media->delete();
            }
       }
        $lead_manager->delete();
        return redirect()->route ('lead_managers.index')->with('success','Lead Manager has been deleted successfully.');;

    }
}
