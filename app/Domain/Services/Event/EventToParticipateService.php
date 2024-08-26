<?php
namespace App\Domain\Services\Event;

use App\Core\Repository\Event\IEventToParticipateRepository;
use App\Core\Repository\Event\IVerifyHowManyParticipantsEventRepository;
use App\Core\Repository\Event\IVerifyIfEventIsPublicRepository;
use App\Core\Service\Event\IEventToParticipateService;
use Exception;

class EventToParticipateService implements IEventToParticipateService
{
    public function __construct(
        private readonly IVerifyHowManyParticipantsEventRepository $verifyHowManyParticipantsEventRepository,
        private readonly IVerifyIfEventIsPublicRepository $verifyIfEventIsPublicRepository,
        private readonly IEventToParticipateRepository $eventToParticipateRepository,
    )
    { }

    /**
     * @throws Exception
     */
    public function eventToParticipate(int $eventId): bool
    {
        $this->checkIfEventHasVacancies($eventId);
        $this->checkIfEventIsPublic($eventId);
        return $this->eventToParticipateRepository->toParticipateEvent($eventId);
    }
    /**
     * @throws Exception
     */
    private function checkIfEventHasVacancies(int $eventId): void
    {
        $quantityParticipants = $this->verifyHowManyParticipantsEventRepository->verifyHoManyParticipants($eventId);
        if ($quantityParticipants[0]['participants'] == $quantityParticipants[0]['max_participants']) {
            throw new Exception('Event has no vacancies');
        }
    }
    /**
     * @throws Exception
     */
    private function checkIfEventIsPublic(int $eventId): void
    {
        if (!$this->verifyIfEventIsPublicRepository->verifyIfEventIsPublic($eventId)) {
            throw new Exception('Event is not public');
        }
    }
}
