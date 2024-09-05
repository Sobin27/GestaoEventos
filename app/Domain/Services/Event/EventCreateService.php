<?php
namespace App\Domain\Services\Event;

use App\Core\Repository\Event\IEventCreateRepository;
use App\Core\Service\Event\IEventCreateService;
use App\Core\Traits\InviteUsersToPrivateEvent;
use App\Http\Requests\Event\CreateEventRequest;

class EventCreateService implements IEventCreateService
{
    use InviteUsersToPrivateEvent;
    public function __construct(
        private readonly IEventCreateRepository $eventCreateRepository
    )
    { }

    public function createEvent(CreateEventRequest $request): bool
    {
        $event = $this->eventCreateRepository->createEvent($request);
        if ($event->type === 'Privada') {
            $this->inviteUsersToPrivateEvent($event, $request->invitesUsers);
        }
        if ($event) return true;
        return false;
    }
}
