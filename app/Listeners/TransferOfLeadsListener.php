<?php

namespace App\Listeners;

use App\Events\TransferOfLeads;
use App\Notifications\TransferOfLeadsNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TransferOfLeadsListener
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
     * @param  TransferOfLeads $event
     * @return void
     */
    public function handle(TransferOfLeads $event)
    {
        if($event->manager != ''){
            $manager = $event->manager;
        }else{
            $lead_manager = $event->lead_manager;
        }
        $new_manager = $event->new_manager;
        if($manager){
            $new_manager->notify(new TransferOfLeadsNotification($manager));
        }else if($lead_manager){
            $new_manager->notify(new TransferOfLeadsNotification($lead_manager));
        }
    }
}
