<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IVerifyIfUserIsOrganizerEventRepository;
use App\Models\Events;

class VerifyIfUserIsOrganizerEventRepository implements IVerifyIfUserIsOrganizerEventRepository
{
    public function verifyIfUserIsOrganizerEvent(int $userId, int $eventId): bool
    {
        return Events::query()->where('id', $eventId)
            ->where('event_organizer', $userId)
            ->exists();
    }
}
