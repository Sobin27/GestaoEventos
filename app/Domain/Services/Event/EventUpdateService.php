<?php
namespace App\Domain\Services\Event;

use App\Core\Repository\Event\IEventFindByIdRepository;
use App\Core\Repository\Event\IEventUpdateRepository;
use App\Core\Service\Event\IEventUpdateService;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Models\Events;

class EventUpdateService implements IEventUpdateService
{
    private UpdateEventRequest $request;
    private Events $events;
    public function __construct(
        private readonly IEventUpdateRepository $eventUpdateRepository,
        private readonly IEventFindByIdRepository $eventFindByIdRepository,
    )
    { }

    public function updateEvent(UpdateEventRequest $request): bool
    {
        $this->setRequest($request);
        $this->setEvent();
        $this->mapperEvent();
        return $this->eventUpdateRepository->updateEvent($this->events);
    }
    private function setRequest(UpdateEventRequest $request): void
    {
        $this->request = $request;
    }
    private function setEvent(): void
    {
        $this->events = $this->eventFindByIdRepository->eventFindById($this->request->eventId);
    }
    private function mapperEvent(): void
    {
        $this->events->name = $this->request->name ?? $this->events->name;
        $this->events->description = $this->request->description ?? $this->events->description;
        $this->events->type = $this->request->type ?? $this->events->type;
        $this->events->organizing_company = $this->request->organizingCompany ?? $this->events->organizing_company;
        $this->events->max_participants = $this->request->maxParticipants ?? $this->events->max_participants;
        $this->events->active = $this->request->active ?? $this->events->active;
        $this->events->max_participants = $this->request->maxParticipants ?? $this->events->max_participants;
        $this->events->duration_time = $this->request->durationTime ?? $this->events->duration_time;
        $this->events->event_date = $this->request->eventDate ?? $this->events->event_date;
        $this->events->address->address = $this->request->address ?? $this->events->address->address;
        $this->events->address->city = $this->request->city ?? $this->events->address->city;
        $this->events->address->country = $this->request->country ?? $this->events->address->country;
        $this->events->address->state = $this->request->state ?? $this->events->address->state;
    }
}
