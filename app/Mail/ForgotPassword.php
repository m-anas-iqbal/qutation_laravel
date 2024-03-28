<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail)
    {
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /* Email Settings */
        $emails = \App\EmailSetting::select('reply_to')->first();
        $setting = \App\WebSetting::select('name')->first();
        $name = $this->mail['name'];
        $email = $this->mail['email'];
        $password = $this->mail['password'];
        
        return $this->view('emails.forgot-password', ['name' => $name,'email' => $email,'password' => $password])->to($email, $name)->replyTo($emails->reply_to, $setting->name)->subject('Forgot Password');
    }
}
