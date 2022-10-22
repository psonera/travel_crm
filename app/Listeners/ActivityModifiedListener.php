<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ActivityModifiedNotfication;

class ActivityModifiedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ActivityModified  $event
     * @return void
     */
    public function handle($event)
    {
        $data = $event;
        if(auth()->user()->hasRole('lead-manager')){
            $authorize_person_id = auth()->user()->authorize_person;
            $manager = User::find($authorize_person_id);
            $to_manager = $manager->email;
            $manager->notify(new ActivityModifiedNotfication($data,$to_manager));
            $admin = User::role('super-admin')->first();
            $to_admin = $admin->email;
            $admin->notify(new ActivityModifiedNotfication($data,$to_admin));
        }elseif(auth()->user()->hasRole('manager')){
            $admin = User::role('super-admin')->first();
            $to_admin = $admin->email;
            $admin->notify(new ActivityModifiedNotfication($data,$to_admin));
        }
    }
}
