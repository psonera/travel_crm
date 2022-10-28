<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\AssignLead;
use App\Notifications\AssignLeadNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssignLeadListener
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
     * @param  AssignLead $assignLead
     * @return void
     */
    public function handle(AssignLead $assignLead)
    {
        $assign_lead = $assignLead->lead;
        $toLm = $assignLead->toLm;
        if($toLm){
            $lead_manager = User::where('id', $assign_lead->lead_manager_id)->first();
            $lead_manager->notify(new AssignLeadNotification($assign_lead));
        } else {
            $manager = User::where('id', $assign_lead->user_id)->first();
            $manager->notify(new AssignLeadNotification($assign_lead));
        }
    }
}
