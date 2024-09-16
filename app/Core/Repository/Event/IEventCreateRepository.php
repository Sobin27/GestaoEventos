<?php
namespace App\Core\Repository\Event;

use App\Http\Requests\Event\CreateEventRequest;
use App\Models\Events;

interface IEventCreateRepository
{
    public function createEvent(CreateEventRequest $request): Events;
}
