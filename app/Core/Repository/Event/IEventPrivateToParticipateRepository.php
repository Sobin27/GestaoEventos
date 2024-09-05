<?php
namespace App\Core\Repository\Event;

interface IEventPrivateToParticipateRepository
{
    public function participateToPrivateEvent(int $eventId, int $userId): bool;
}
