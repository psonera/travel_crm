<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\ActivityCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ActivityCreatedNotification;

class ActivityCreatedListener
{
    /**
     * Create the activity listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the activity.
     *
     * @param  \App\Events\ActivityCreated  $event
     * @return void
     */
    public function handle(ActivityCreated $event)
    {
        $data = $event;
        if(auth()->user()->hasRole('lead-manager')){
            $authorize_person_id = auth()->user()->authorize_person;
            $manager = User::find($authorize_person_id);
            $to_manager = $manager->email;
            $manager->notify(new ActivityCreatedNotification($data,$to_manager));
            $admin = User::role('super-admin')->first();
            if($manager->id != $admin->id){
                $to_admin = $admin->email;
                $admin->notify(new ActivityCreatedNotification($data,$to_admin));
            }
        }elseif(auth()->user()->hasRole('manager')){
            $admin = User::role('super-admin')->first();
            $to_admin = $admin->email;
            $admin->notify(new ActivityCreatedNotification($data,$to_admin));
        }
    }
}
