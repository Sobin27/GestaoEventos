<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IEventFindByIdRepository;
use App\Models\Events;

class EventFindByIdRepository implements IEventFindByIdRepository
{
    public function eventFindById(int $eventId): Events
    {
        return Events::query()
            ->where('id', $eventId)
            ->get()
            ->first();
    }
}
