<?php
namespace App\Listeners;

use App\Events\InviteUsersToPrivateEvent;
use App\Mail\InviteUsersToPrivateEventMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailForEventUsers
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
    public function handle(InviteUsersToPrivateEvent $event): void
    {
        $users = User::query()->whereIn('id', $event->usersIds)->get();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new InviteUsersToPrivateEventMail($event->events, $user));
        }
    }
}
