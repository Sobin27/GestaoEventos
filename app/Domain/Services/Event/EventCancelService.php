<?php
namespace App\Domain\Services\Event;

use App\Core\Repository\Event\IEventCancelRepository;
use App\Core\Service\Event\IEventCancelService;
use App\Core\Traits\CancelEvent;

class EventCancelService implements IEventCancelService
{
    use CancelEvent;
    public function __construct(
        private readonly IEventCancelRepository $eventCancelRepository
    )
    { }
    public function cancelEvent(int $eventId): bool
    {
        $this->sendEmail($eventId);
        return $this->eventCancelRepository->cancelEvent($eventId);
    }
    private function sendEmail(int $eventId): void
    {
        $this->eventCancel($eventId);
    }
}
