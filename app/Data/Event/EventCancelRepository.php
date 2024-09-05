<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IEventCancelRepository;
use App\Models\Events;

class EventCancelRepository implements IEventCancelRepository
{
    public function cancelEvent(int $eventId): bool
    {
        return Events::query()->where('id', $eventId)
            ->update([
                'active' => false,
                'updated_at' => now()
            ]);
    }
}
