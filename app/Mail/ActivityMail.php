<?php

namespace App\Mail;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivityMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject_line, $activity, $fromAddress, $toAddress, $fullname;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fromAddress, $toAddress, $subject_line, $activity, $fullname)
    {
        $this->fromAddress = $fromAddress; 
        $this->toAddress = $toAddress; 
        $this->subject_line = $subject_line;
        $this->activity = $activity;
        $this->fullname = $fullname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = array();
        if($this->activity->type == 'note' || $this->activity->type == 'file'){ 
            $hide = ['is_done', 'user_id', 'updated_at', 'created_at', 'id', 'schedule_from', 'schedule_to', 'location'];
        } else {
            $hide = ['is_done', 'user_id', 'created_at', 'id'];
        }
        $data['activity_data'] = $this->activity->makeHidden($hide)->toArray();
        $data['name'] = $this->fullname;
        $data['created'] = Str::contains($this->subject_line, 'Created') ? true : false;

        return $this->from($this->fromAddress)
                    ->to($this->toAddress)
                    ->subject($this->subject_line)
                    ->markdown('mails.activity-mail-template', ($data));
    }
}
