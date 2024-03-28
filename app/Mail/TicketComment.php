<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketComment extends Mailable
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
        $ticket = $this->mail['ticket'];
        $comment = $this->mail['comment'];
        $subject = $ticket.' - Comment';

        return $this->view('emails.comment-email', ['ticket' => $ticket,'comment' => $comment])
            ->to('fernandezf@healthsystemone.com', 'Franklin Fernandez')
            ->bcc('fernandez954@gmail.com')
            ->replyTo($emails->reply_to, $setting->name)
            ->subject($subject);

    }
}
