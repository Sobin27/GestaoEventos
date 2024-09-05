<?php
namespace App\Core\Service\Event;

interface IEventCancelService
{
    public function cancelEvent(int $eventId): bool;
}
