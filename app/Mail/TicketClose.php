<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketClose extends Mailable
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
        $ticket = $this->mail['ticket'];
        $ticket_id = $this->mail['ticket_id'];
        $user_id = $this->mail['user_id'];
        $attachments = $this->mail['attachments'];
        $project = $this->mail['project'];
        $comment = $this->mail['comment'];
        $instructions = $this->mail['instructions'];
        $bcc = $this->mail['bcc'];
        $subject = $ticket.' - '.$project;
        $array = array(
            0 => $ticket_id,
            1 => $user_id
        );
        $url = encrypt(implode("::", $array));
        $bcc = $bcc != '' ? explode(',',$bcc) : [];

        return $this->view('emails.ticket-close', ['url' => $url,'comment' => $comment,'attachments' => $attachments,'name' => $name,'ticket' => $ticket,'project' => $project,'instructions' => $instructions])
            ->to($email, $name)
            ->bcc($bcc, env('APP_NAME'))
            ->replyTo($emails->reply_to, $setting->name)
            ->subject($subject);

    }
}
