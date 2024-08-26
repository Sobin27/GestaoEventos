<?php
namespace App\Core\Service\Event;

use App\Http\Requests\Event\CreateEventRequest;

interface IEventCreateService
{
    public function createEvent(CreateEventRequest $request): bool;
}
