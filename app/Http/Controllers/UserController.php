<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Events\AssignLead;
use App\Models\LeadSource;
use Illuminate\Http\Request;
use App\Events\TransferOfLeads;
use App\Events\TransferOfControl;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('users',User::class);
        return view('settings.users.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create.users',User::class);
        return view('settings.users.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('store.users',User::class);
        $request->validate
        ([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','regex:/(91)[0-9]{10}/','max:12','min:12'],
            'password' => ['required', 'string', 'confirmed'],
            'status'=> ['required'],
            'profile_image'=>['sometimes','mimes:jpg,png','size:max:5000'],
        ]);
        if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('Manager')){
                $request->validate(['role'=>'required']);
        }
        if(auth()->user()->hasRole('super-admin')){
           if($request->has('manager')){
                $request->validate(['manager'=>'required']);
                $request->validate(['r_manager'=>'required']);
           }
        }
        // dd($request->all());
        $is_admin = 0;
        $is_manager= 0;
        $is_lead_manager = 0;
        $is_exist = 1;


        if($request->has('role')){
            if(strtolower(str_replace(' ','',Role::where('id',$request->role)->first()->name))=='superadmin'){
                $is_admin = 1;
            }
            if(strtolower(str_replace(' ','',Role::where('id',$request->role)->first()->name))=='manager'){
                $is_manager= 1;
            }
            if(strtolower(str_replace(' ','-',Role::where('id',$request->role)->first()->name))=='lead-manager'){
                $is_lead_manager = 1;
            }
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->is_admin = $is_admin;
        $user->is_manager = $is_manager;
        $user->is_lead_manager = $is_lead_manager;
       if(auth()->user()->hasRole('super-admin')) {
            if($request->has('manager')){
                $user->authorize_person = $request->r_manager;
            }else{
                $user->authorize_person = auth()->user()->id;
            }
       }else{
            $user->authorize_person = auth()->user()->id;
       }
        if($request->has('source')){
            $user->lead_source_id = $request->source;
        }
        if(Auth::user()->hasRole('Lead Manager')){
            $is_exist = 0;
            $user->is_existing = $is_exist;
        }
        $user->save();
        if($request->has('role')){
            $role  = Role::find($request->role);
            // dd($role);
            $user->syncRoles([$role]);
        }
        if($request->has('profile_image')){
            $user->addMedia($request->profile_image)
                ->toMediaCollection('media','media_file');
        }
        return redirect()->route('settings.users.index')->with('success','User has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view.users',User::class);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
       if(Auth::user()){
       }else{
            $this->authorize('update.users',User::class);
       }
       $roles = Role::all();
       return view('settings.users.edit',['user'=>$user,"roles"=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {

        $request->validate
        ([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required','regex:/(91)[0-9]{10}/','max:12','min:12'],
            'status'=> ['required'],
            'profile_image'=>['sometimes','mimes:jpg,png','size:max:5000']
        ]);
        if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('manager')){
            if($user->hasAnyRole(Role::all())){
                $request->validate(['role'=>'required']);
            }
            if($request->has('lead_manager')){

                $request->validate(['lead_manager'=>'required']);
                $request->validate(['r_lead_manager'=>'required']);
            }
        }
        if(auth()->user()->hasRole('super-admin')){
            if($request->has('manager')){
                $request->validate(['r_manager'=>'required']);
                 $request->validate(['manager'=>'required']);
            }
        }
        $is_admin = 0;
        $is_manager= 0;
        $is_lead_manager = 0;
        $is_exist = 1;
        if($request->has('role')){
            if(strtolower(str_replace('-','',Role::where('id',$request->role)->first()->name))=='superadmin'){
                $is_admin = 1;
            }
            if(strtolower(str_replace('-','',Role::where('id',$request->role)->first()->name))=='manager'){
                $is_manager= 1;
            }
            if(strtolower(str_replace('-','',Role::where('id',$request->role)->first()->name))=='leadmanager'){
                $is_lead_manager = 1;
            }
        }
        if($user)
        {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone;
            $user->password = Hash::make($request->password);
            $user->status = $request->status;
            $user->is_admin = $is_admin;
            $user->is_manager = $is_manager;
            $user->is_lead_manager = $is_lead_manager;
            if($user->hasAnyRole(Role::all())){
                if(auth()->user()->hasRole('super-admin')) {
                    if($request->has('manager')){
                        $user->authorize_person = $request->r_manager;
                    }
               }else{
                    $user->authorize_person = auth()->user()->id;
               }
            }else{
                // Assign New Lead-Manager to Lead
                $user->authorize_person = $request->r_lead_manager;
            }
            if($request->has('source')){
                $user->lead_source_id = $request->source;
            }
            if(Auth::user()->hasRole('lead-manager')){
                $is_exist = 0;
                $user->is_existing = $is_exist;
            }

            $user->save();
            if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('manager') ){
                if($request->has('role')){

                    $role = Role::find($request->role);
                    $user->syncRoles([$role]);
                }
             }
             if($request->has('profile_image')){
                //delete old image
               if(count($user->getMedia('media')) > 0){
                    foreach($user->getMedia('media') as $media){
                        $media->delete();
                    }
               }
                //insert image
                $user->addMedia($request->profile_image)
                    ->toMediaCollection('media','media_file');
            }elseif(!$request->has('profile_image')){
                if(count($user->getMedia('media')) > 0){
                    foreach($user->getMedia('media') as $media){
                        $media->delete();
                    }
                }
            }
        }
        return redirect()->route('settings.users.index')->with('success','User has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete.users',User::class);
        $super_admin = User::role('super-admin')->first();
        $all_leads = Lead::where('user_id',$user->id)->get();
        //assign all manager's lead_managers and Leads to super_admin
        $all_lead_managers = User::where('authorize_person',$user->id)->get();
        // dd($all_lead_managers);
        if($user->is_manager==1){

            if(count($all_lead_managers) > 0){
                foreach($all_lead_managers as $lead_manager){
                    $lead_manager->authorize_person = $super_admin->id;
                    $lead_manager->save();
                }

            }
            if(count($all_leads) > 0){
                foreach($all_leads as $lead){
                    $lead->user_id = $super_admin->id;
                    $lead->save();
                }
                $data['lead_manager_name'] = $user->name;
                $data['manager_name'] = $super_admin->name;
                TransferOfLeads::dispatch($data);
            }
        }
        //assign all lead_manager's  Leads to super_admin

        else if($user->is_lead_manager==1){
            $all_leads = Lead::where('lead_manager_id',$user->id)->get();
            $manager = User::where('authorize_person',$user->authorize_person)->first();
             if(count($all_leads) > 0){
                foreach($all_leads as $lead){
                    $lead->lead_manager_id = $manager->id;
                    $lead->save();
                }
                $data['lead_manager_name'] = $user->name;
                $data['manager_name'] = $manager->name;
                TransferOfLeads::dispatch($data);
            }
        }
        foreach($user->getMedia('media') as $media){
            $media->delete();
        }
        $user->delete();
        return redirect()->route('settings.users.index')->with('success','User Deleted successfully.');
    }

    //api

    public function getSources(){
        return response()->json(LeadSource::select('id','name')->get());
    }
    public function isLeadManager($id){
        if($id==""){
            return response()->json(false) ;
        }
        $role = Role::findOrFail($id);
        $name = str_replace(' ','-',strtolower($role->name));
        if($name=="lead-manager"){
            return response()->json(true) ;
        }
        else{
            return response()->json(false) ;
        }
    }

    public function isAdmin(){
        $isadmin = false;
        if(auth()->user()->is_admin==1){
            $isadmin=true;
        }
        return response()->json($isadmin);
    }
    public function managers($query){
        $managers = User::select("id","name")->where('is_manager',"1")->where('name','like',"%".$query."%")->get();
        return response()->json($managers);
    }
}
