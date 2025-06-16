<?php

namespace App\Listeners;

use App\Events\MailSendIndividual;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;

class MailforIndividualListener
{
    /**
     * Create the event listener.
     */
    // public $name;
    // public $email;

    // public function __construct($mailData)
    // {
    //     $this->name = $mailData['name'];
    //     $this->email = $mailData['email'];
    // }

    /**
     * Handle the event.
     */
    public function handle(MailSendIndividual $event): void
    {
        $name = $event->name;
        $email = $event->email;

        $data = [
            'name' => $name,
            'email' => $email,
        ];

        Mail::to($email)->send(new ContactEmail($data));
    }
}
