<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransferOfLeadsNotification extends Notification
{
    use Queueable;

    public $auth_person;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        if($data->manager){
            $this->auth_person = $data->manager;
        }else {
            $this->auth_person = $data->lead_manager;
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $from = auth()->user()->email;
        $line_one = "The person under you have been removed! So all the leads have been assigned to you! Please Check!";
        return (new MailMessage)
                    ->from($from)
                    ->subject('Leads Transfer')
                    ->line($line_one)
                    ->line('Thank you');
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return 
    */
    public function toDatabase($notifiable)
    {
        return [
            'subject'=> 'lead',
            'message' => 'The person under you have been removed! So all the leads have been assigned to you! Please Check!'
        ];
    }
}
