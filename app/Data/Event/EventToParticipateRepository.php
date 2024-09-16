<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IEventToParticipateRepository;
use App\Models\EventUser;

class EventToParticipateRepository implements IEventToParticipateRepository
{
    public function toParticipateEvent(int $eventId): bool
    {
        $eventUser = EventUser::query()->create([
            'event_id' => $eventId,
            'participant_id' => auth()->user()->id
        ]);
        if ($eventUser) return true;
        return false;
    }
}
