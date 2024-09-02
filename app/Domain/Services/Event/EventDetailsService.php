<?php
namespace App\Domain\Services\Event;

use App\Core\Repository\Event\IEventDetailsRepository;
use App\Core\Service\Event\IEventDetailsService;

class EventDetailsService implements IEventDetailsService
{
    public function __construct(
        private readonly IEventDetailsRepository $eventDetailsRepository
    )
    { }

    public function getDetailsEvents(int $eventId): array
    {
        return $this->eventDetailsRepository->getDetailsEvents($eventId);
    }
}
