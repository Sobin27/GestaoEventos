<?php
namespace App\Core\Repository\Event;

use App\Models\Events;

interface IEventUpdateRepository
{
    public function updateEvent(Events $events): bool;
}
