<?php
namespace App\Domain\Services\Event;

use App\Core\Repository\Event\IEventCreateRepository;
use App\Core\Service\Event\IEventCreateService;
use App\Http\Requests\Event\CreateEventRequest;

class EventCreateService implements IEventCreateService
{
    public function __construct(
        private readonly IEventCreateRepository $eventCreateRepository
    )
    { }

    public function createEvent(CreateEventRequest $request): bool
    {
        return $this->eventCreateRepository->createEvent($request);
    }
}
