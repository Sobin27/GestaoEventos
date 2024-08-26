<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IVerifyIfEventIsPublicRepository;
use App\Models\Events;

class VerifyIfEventIsPublicRepository implements IVerifyIfEventIsPublicRepository
{
    public function verifyIfEventIsPublic(int $eventId): bool
    {
        return Events::query()
            ->where('id', $eventId)
            ->where('type', '=', 'Publica')
            ->exists();
    }
}
