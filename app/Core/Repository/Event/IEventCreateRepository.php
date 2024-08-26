<?php
namespace App\Core\Repository\Event;

use App\Http\Requests\Event\CreateEventRequest;

interface IEventCreateRepository
{
    public function createEvent(CreateEventRequest $request): bool;
}
