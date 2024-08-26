<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IEventUpdateRepository;
use App\Models\Events;

class EventUpdateRepository implements IEventUpdateRepository
{
    public function updateEvent(Events $events): bool
    {
        return $events->update() and $events->address->update();
    }
}
