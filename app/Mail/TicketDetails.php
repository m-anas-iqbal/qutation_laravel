<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketDetails extends Mailable
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
        $emails = \App\EmailSetting::select('recipient_status', 'recipient_subject', 'reply_to')->first();
        $setting = \App\WebSetting::select('name')->first();

        /* Ticket Details */
        $attachments = $this->mail['attachments'];
        $ticket = $this->mail['ticket'];
        $user = $this->mail['user'];
        $user_email = $this->mail['user_email'];
        $priority = $this->mail['priority'];
        $duedate = $this->mail['duedate'];
        $company = $this->mail['company'];
        $project = $this->mail['project'];
        $instructions = $this->mail['instructions'];
        $category = $this->mail['category'];
        $subject = $ticket . ' - ' . $project;

        /* Recipient Settings */
        $recipients_mail = [];
        if ($emails->recipient_status == 1) {
            $recipients = \App\Recipient::orderBy('id', 'asc')->get();
            foreach ($recipients as $recipient) {
                array_push($recipients_mail, $recipient->recipient_mail);
            }
        }

        /* Ticket Details */
        return $this->view('emails.ticket', ['attachments' => $attachments, 'ticket' => $ticket, 'user' => $user, 'duedate' => $duedate, 'company' => $company, 'project' => $project, 'instructions' => $instructions, 'category' => $category, 'priority' => $priority])
            ->to($user_email, $user)
            ->bcc($recipients_mail)
            ->replyTo($emails->reply_to, $setting->name)
            ->subject($subject);
    }
}
