<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignLeadNotification extends Notification
{
    use Queueable;

    public $assign_lead;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($assign_lead)
    {
        $this->assign_lead = $assign_lead;
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
        $line_one = "There is a new lead under you! Please Check!";
        return (new MailMessage)
                    ->from($from)
                    ->subject('New Lead Assigned To You')
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
            'message' => 'A lead is assigned to you! Please Check!',
            'lead_id' => $this->assign_lead->id
        ];
    }
}
