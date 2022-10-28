<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\NewLead;
use App\Notifications\NewLeadNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewLeadListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(NewLead $lead)
    {
        $new_lead = $lead->lead;
        $manager = User::where('id', $new_lead->user_id)->first();
        $lead_manager = User::where('id', $new_lead->lead_manager_id)->first();

        $manager->notify(new NewLeadNotification($new_lead));
        $lead_manager->notify(new NewLeadNotification($new_lead));
    }
}
