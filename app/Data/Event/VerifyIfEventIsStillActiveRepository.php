<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IVerifyIfEventIsStillActiveRepository;
use App\Models\Events;

class VerifyIfEventIsStillActiveRepository implements IVerifyIfEventIsStillActiveRepository
{
    public function verifyIfEventIsStillActive(int $eventId): bool
    {
        return Events::query()
            ->where('id', $eventId)
            ->where('active', true)
            ->exists();
    }
}
