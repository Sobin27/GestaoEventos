<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IEventPrivateToParticipateRepository;
use App\Models\EventUser;

class EventPrivateToParticipateRepository implements IEventPrivateToParticipateRepository
{
    public function participateToPrivateEvent(int $eventId, int $userId): bool
    {
        $eventUser = EventUser::query()->create([
            'event_id' => $eventId,
            'participant_id' => $userId,
            'created_at' => now(),
        ]);
        if ($eventUser) return true;
        return false;
    }
}
