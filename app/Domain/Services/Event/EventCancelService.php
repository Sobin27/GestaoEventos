<?php
namespace App\Domain\Services\Event;

use App\Core\Repository\Event\IEventCancelRepository;
use App\Core\Repository\Event\IEventFindByIdRepository;
use App\Core\Repository\Event\IVerifyIfUserIsOrganizerEventRepository;
use App\Core\Service\Event\IEventCancelService;
use App\Core\Traits\CancelEvent;
use Exception;

class EventCancelService implements IEventCancelService
{
    use CancelEvent;
    public function __construct(
        private readonly IEventCancelRepository $eventCancelRepository,
        private readonly IVerifyIfUserIsOrganizerEventRepository $verifyIfUserIsOrganizerEventRepository,
        private readonly IEventFindByIdRepository $eventFindByIdRepository
    )
    { }

    /**
     * @throws Exception
     */
    public function cancelEvent(int $eventId): bool
    {
        $this->checkIfUserIsOrganizer($eventId);
        $this->sendEmail($eventId);
        return $this->eventCancelRepository->cancelEvent($eventId);
    }
    private function sendEmail(int $eventId): void
    {
        $this->eventCancel($this->eventFindByIdRepository->eventFindById($eventId));
    }
    /**
     * @throws Exception
     */
    private function checkIfUserIsOrganizer(int $eventId): void
    {
        if (!$this->verifyIfUserIsOrganizerEventRepository->verifyIfUserIsOrganizerEvent(auth()->user()->id, $eventId)) {
            throw new Exception('You are not the organizer of this event');
        }
    }
}
