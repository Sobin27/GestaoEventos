<?php
namespace App\Domain\Services\Event;

use App\Core\Repository\Event\IEventStopParticipatingRepository;
use App\Core\Service\Event\IEventStopParticipatingService;

class EventStopParticipatingService implements IEventStopParticipatingService
{
    public function __construct(
        private readonly IEventStopParticipatingRepository $eventStopParticipatingRepository
    )
    { }

    public function stopParticipating(int $eventId): bool
    {
        return $this->eventStopParticipatingRepository->stopParticipating($eventId);
    }
}
