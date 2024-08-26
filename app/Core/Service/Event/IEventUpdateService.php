<?php
namespace App\Core\Service\Event;

use App\Http\Requests\Event\UpdateEventRequest;

interface IEventUpdateService
{
    public function updateEvent(UpdateEventRequest $request): bool;
}
