<?php
namespace App\Domain\Services\Event;

use App\Core\Repository\Event\IEventPrivateToParticipateRepository;
use App\Core\Service\Event\IEventPrivateToParticipateService;

class EventPrivateToParticipateService implements IEventPrivateToParticipateService
{
    public function __construct(
        private readonly IEventPrivateToParticipateRepository $eventPrivateToParticipateRepository
    )
    { }
    public function participateToPrivateEvent(int $eventId, int $userId): bool
    {
        return $this->eventPrivateToParticipateRepository->participateToPrivateEvent($eventId, $userId);
    }
}
