<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lead;
use App\Models\Message;
use App\Models\Messagetype;
use Twilio\Rest\Client;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function smsReminder(){

        $leads = Lead::get();
        $messagetype = Messagetype::find(1);

        $date1 = Carbon::today();
        $date2 ="";
        foreach($leads as $lead){
            if($lead->selected_trip_date!=null && $lead->selected_trip_date >= Carbon::today()){
                $date2 = $lead->selected_trip_date;
            }else{
                $date2 = $lead->trip->start_date;
            }
            $diff = $date1->diffInDays($date2);

            if($diff < 15){
                $number = $lead->user->phone_number;
                $name = $lead->user->name;
                $trip = $lead->trip->title;
                $message = "Hello, $name This is a friendly reminder that you have $diff  days left for your $trip trip. Thanks ";
                if($this->sendsms($number,$message)){
                    $messageobj = new Message();
                    $messageobj->message = $message;
                    $messageobj->lead_id = $lead->id;
                    $messageobj->messagetype_id = $messagetype->id;
                    $messageobj->save();
                }
           }
        }
    }

    public function sendsms($number,$message){
        try {
            $account_sid = getenv("TWILIO_ACCOUNT_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_PHONE_NUMBER");
            $to = $number;
            $message = $message;
            $client = new Client($account_sid,$auth_token);
            $client->messages->create(
                $to,
                [
                    "from"=>$twilio_number,
                    "body"=>$message
                ]
            );
            return true;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
