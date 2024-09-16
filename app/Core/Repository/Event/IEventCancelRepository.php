<?php
namespace App\Core\Repository\Event;

interface IEventCancelRepository
{
    public function cancelEvent(int $eventId): bool;
}
