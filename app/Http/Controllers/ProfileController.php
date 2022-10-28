<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $this->authorize("update.users",User::class);
       return view('profile.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function update(Request $request, User $user)
    {
        $this->authorize("update.users",User::class);
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required','regex:/(91)[0-9]{10}/','max:12','min:12'],
            'profile_image'=>['sometimes','mimes:jpg,png','size:5000'],
        ]);
        if($user){
            $user->update([
                'name' => $request->name ? $request->name : $user->name,
                'email' => $request->email ? $request->email : $user->email,
                'phone_number' => $request->phone,
            ]);

            if($request->has('profile_image')){
                if(count($user->getMedia('profile_image')) > 0){
                    foreach($user->getMedia('profile_image') as $media){
                        $media->delete();
                    }
                }
                $user->addMedia($request->profile_image)
                    ->preservingOriginal()
                    ->toMediaCollection('profile_image');

                $user->save();
            }
            $user->save();
        }
        
        return redirect()->route('profile.edit', $user)->with('success','Your profile has been updated successfully!'); 
    }
}
