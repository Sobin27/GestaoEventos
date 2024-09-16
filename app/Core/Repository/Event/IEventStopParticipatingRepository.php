<?php
namespace App\Core\Repository\Event;

interface IEventStopParticipatingRepository
{
    public function stopParticipating(int $eventId): bool;
}
