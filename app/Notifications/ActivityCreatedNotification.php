<?php

namespace App\Notifications;

use App\Mail\ActivityMail;
use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ActivityCreatedNotification extends Notification
{
    use Queueable;

    public $activity, $to, $lead_name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($activity,$to)
    {
        $this->to = $to;
        $this->activity = $activity->activity['activity'];
        $this->lead_name = $activity->activity['lead_name'];
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
     * @return void
     */
    public function toMail($notifiable)
    {
        $subject_line = 'Activity Created';
        
        $fromAddress = auth()->user()->email;

        $fullname = auth()->user()->name;

        $toAddress = $this->to;
        
        return new ActivityMail($fromAddress, $toAddress, $subject_line, $this->activity, $fullname);
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return 
     */
    public function toDatabase($notifiable)
    {
        $assigner_name = auth()->user()->name;
        return [
            'subject'=> 'activity',
            'message' => 'Activity Created for '. $this->lead_name.' by '. $assigner_name. ' for more info check your Mail Inbox!',
            'activity_id' => $this->activity->id
        ];
    }
}
