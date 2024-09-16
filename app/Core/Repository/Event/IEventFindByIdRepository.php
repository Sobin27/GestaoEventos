<?php
namespace App\Core\Repository\Event;

use App\Models\Events;

interface IEventFindByIdRepository
{
    public function eventFindById(int $eventId): Events;
}
