<?php
namespace App\Core\Service\Event;

interface IEventStopParticipatingService
{
    public function stopParticipating(int $eventId): bool;
}
