<?php
namespace App\Core\Repository\Event;

interface IEventToParticipateRepository
{
    public function toParticipateEvent(int $eventId): bool;
}
