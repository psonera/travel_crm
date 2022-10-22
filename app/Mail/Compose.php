<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Compose extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data,
           $name,
           $email,
           $subject;


    public function __construct($data,$email,$subject)
    {
        $this->subject = $subject;
        $this->email = $email;
        $this->data = $data;
        $this->name = Auth::user()->name;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this ->cc($this->email['cc'])->bcc($this->email['bcc'])->subject($this->subject)->from(Auth::user()->email);

       if(count($this->data['mail']->getMedia('attachment'))>0){
        foreach ($this->data['mail']->getMedia('attachment') as $file){
            $path = 'app/public/attachment/'.$file->id.'/'.$file->file_name;
            $this->attach(storage_path($path));
        }
       }

        $this->markdown('mails.email-template',($this->data));
        return $this;
    }

}