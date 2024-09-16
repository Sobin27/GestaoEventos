<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IEventStopParticipatingRepository;
use App\Models\EventUser;

class EventStopParticipatingRepository implements IEventStopParticipatingRepository
{
    public function stopParticipating(int $eventId): bool
    {
        return EventUser::query()
            ->where('participant_id', auth()->user()->id)
            ->where('event_id', $eventId)
            ->delete();
    }
}
