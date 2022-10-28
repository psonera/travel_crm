<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLeadNotification extends Notification
{
    use Queueable;

    public $new_lead;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($new_lead)
    {   
        $this->new_lead = $new_lead;
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
                    ->subject('New Lead')
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
            'message' => 'There is a new Lead under you! Please Check!',
            'lead_id' => $this->new_lead->id
        ];
    }
}
