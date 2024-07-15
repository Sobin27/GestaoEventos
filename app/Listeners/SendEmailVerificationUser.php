<?php

namespace App\Listeners;

use App\Events\CreateNewUser;
use App\Mail\EmailVerificationUserMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreateNewUser $event): void
    {
        Mail::to($event->user->email)->send(new EmailVerificationUserMail($event->user));
    }
}
