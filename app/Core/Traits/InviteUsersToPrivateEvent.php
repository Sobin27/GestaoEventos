<?php
namespace App\Core\Traits;

use App\Events\InviteUsersToPrivateEvent as Event;
use App\Models\Events;

trait InviteUsersToPrivateEvent
{
    public function inviteUsersToPrivateEvent(Events $events, array $usersIds): void
    {
        Event::dispatch($events, $usersIds);
    }
}
