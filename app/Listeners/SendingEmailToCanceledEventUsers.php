<?php

namespace App\Listeners;

use App\Events\CancelEvent;
use App\Mail\EmailEventCanceled;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendingEmailToCanceledEventUsers
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
    public function handle(CancelEvent $event): void
    {
        $participatingUsers = EventUser::query()
            ->where('event_id', $event->events->id)
            ->get()
            ->pluck('participant_id');
        $users = User::query()
            ->whereIn('id', $participatingUsers)
            ->get();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new EmailEventCanceled($event->events, $user));
        }
    }
}
