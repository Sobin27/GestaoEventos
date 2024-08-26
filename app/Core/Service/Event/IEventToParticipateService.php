<?php
namespace App\Core\Service\Event;

interface IEventToParticipateService
{
    public function eventToParticipate(int $eventId): bool;
}
