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
        if(array_key_exists('manager',$event->data)){
            $manager = $event->data['manager'];
        }else{
            $lead_manager = $event->data['lead_manager'];
        }
        $new_manager = $event->data['new_manager'];
        if(array_key_exists('manager',$event->data)){
            $new_manager->notify(new TransferOfLeadsNotification($manager));
        }else if($lead_manager){
            $new_manager->notify(new TransferOfLeadsNotification($lead_manager));
        }
    }
}
