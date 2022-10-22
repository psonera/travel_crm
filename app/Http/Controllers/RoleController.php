<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rolevalidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('roles', Role::class);

        return view('settings.roles.index');
    }

    public function allrole(){
         $role = [];
         if(Auth::user()->hasRole('super-admin')){
            $role = Role::all();
         }

         if(Auth::user()->hasRole('manager')){
            $role = Role::where('name','lead-manager')->get();
         }
         return response()->json($role);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create.roles', Role::class);
        $permissions = Permission::all();

        return view('settings.roles.create')->with('permissions', $permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Rolevalidation $request)
    {
        $this->authorize('store.roles', Role::class);

        $role = Role::create(
            [
            'name'=>$request->name,
            'guard_name'=>$request->guard_name
            ]
         );

        if($request->has('permission')){
            $permissions = Permission::find($request->permission);
        }else{
            $permissions = Permission::all();
        }

        $role->syncPermissions($permissions);
        return redirect(route('settings.roles.index'));


        // $this->authorize('create', Role::class);

        // $data = $this->validate($request, [
        //     'name' => 'required|unique:roles|max:32',
        //     'permissions' => 'array',
        // ]);
        // $role = Role::create($data);

        // $validated = $request->validated();
        // $role = Role::create($validated);


        // $permissions = Permission::find($request->permissions);
        // $role->syncPermissions($permissions);

        // return redirect()
        //     ->route('settings.roles.edit', $role->id)
        //     ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $this->authorize('view.roles', Role::class);

        return view('app.settings.roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update.roles', $role);

        $permissions = Permission::all();

        return view('settings.roles.edit')
            ->with('role', $role)
            ->with('permissions', $permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Rolevalidation $request, Role $role)
    {

        $role->name = $request->name;
        $role->guard_name = $request->guard_name;
        $role->save();
        if($request->has('permission')){
            $permissions = Permission::find($request->permission);
        }else{
            $permissions = Permission::all();
        }

        $role->syncPermissions($permissions);

        return redirect()
            ->route('settings.roles.index')
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete.roles', $role);

        $role->delete();
        return redirect()
            ->route('settings.roles.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
