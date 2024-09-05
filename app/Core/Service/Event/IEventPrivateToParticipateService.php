<?php
namespace App\Core\Service\Event;

interface IEventPrivateToParticipateService
{
    public function participateToPrivateEvent(int $eventId, int $userId): bool;
}
