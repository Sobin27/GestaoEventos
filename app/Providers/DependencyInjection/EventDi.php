<?php
namespace App\Providers\DependencyInjection;

use App\Core\Repository\Event\IEventCancelRepository;
use App\Core\Repository\Event\IEventCreateRepository;
use App\Core\Repository\Event\IEventDetailsRepository;
use App\Core\Repository\Event\IEventFindByIdRepository;
use App\Core\Repository\Event\IEventGetParticipantsRepository;
use App\Core\Repository\Event\IEventListRepository;
use App\Core\Repository\Event\IEventPrivateToParticipateRepository;
use App\Core\Repository\Event\IEventStopParticipatingRepository;
use App\Core\Repository\Event\IEventToParticipateRepository;
use App\Core\Repository\Event\IEventUpdateRepository;
use App\Core\Repository\Event\IMyEventsListRepository;
use App\Core\Repository\Event\IVerifyHowManyParticipantsEventRepository;
use App\Core\Repository\Event\IVerifyIfEventIsPublicRepository;
use App\Core\Repository\Event\IVerifyIfEventIsStillActiveRepository;
use App\Core\Repository\Event\IVerifyIfUserIsOrganizerEventRepository;
use App\Core\Service\Event\IEventCancelService;
use App\Core\Service\Event\IEventCreateService;
use App\Core\Service\Event\IEventDetailsService;
use App\Core\Service\Event\IEventInviteParticipantsPrivateService;
use App\Core\Service\Event\IEventListService;
use App\Core\Service\Event\IEventPrivateToParticipateService;
use App\Core\Service\Event\IEventStopParticipatingService;
use App\Core\Service\Event\IEventToParticipateService;
use App\Core\Service\Event\IEventUpdateService;
use App\Core\Service\Event\IMyEventsListService;
use App\Data\Event\EventCancelRepository;
use App\Data\Event\EventCreateRepository;
use App\Data\Event\EventDetailsRepository;
use App\Data\Event\EventFindByIdRepository;
use App\Data\Event\EventGetParticipantsRepository;
use App\Data\Event\EventListRepository;
use App\Data\Event\EventPrivateToParticipateRepository;
use App\Data\Event\EventStopParticipatingRepository;
use App\Data\Event\EventToParticipateRepository;
use App\Data\Event\EventUpdateRepository;
use App\Data\Event\MyEventsListRepository;
use App\Data\Event\VerifyHowManyParticipantsEventRepository;
use App\Data\Event\VerifyIfEventIsPublicRepository;
use App\Data\Event\VerifyIfEventIsStillActiveRepository;
use App\Data\Event\VerifyIfUserIsOrganizerEventRepository;
use App\Domain\Services\Event\EventCancelService;
use App\Domain\Services\Event\EventCreateService;
use App\Domain\Services\Event\EventDetailsService;
use App\Domain\Services\Event\EventListService;
use App\Domain\Services\Event\EventPrivateToParticipateService;
use App\Domain\Services\Event\EventStopParticipatingService;
use App\Domain\Services\Event\EventToParticipateService;
use App\Domain\Services\Event\EventUpdateService;
use App\Domain\Services\Event\MyEventsListService;

class EventDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [IEventCreateService::class, EventCreateService::class],
            [IEventToParticipateService::class, EventToParticipateService::class],
            [IEventUpdateService::class, EventUpdateService::class],
            [IEventListService::class, EventListService::class],
            [IEventDetailsService::class, EventDetailsService::class],
            [IEventStopParticipatingService::class, EventStopParticipatingService::class],
            [IMyEventsListService::class, MyEventsListService::class],
            [IEventCancelService::class, EventCancelService::class],
            [IEventPrivateToParticipateService::class, EventPrivateToParticipateService::class],
        ];
    }
    protected function repositories(): array
    {
        return [
            [IEventCreateRepository::class, EventCreateRepository::class],
            [IVerifyHowManyParticipantsEventRepository::class, VerifyHowManyParticipantsEventRepository::class],
            [IVerifyIfEventIsPublicRepository::class, VerifyIfEventIsPublicRepository::class],
            [IEventToParticipateRepository::class, EventToParticipateRepository::class],
            [IVerifyIfEventIsStillActiveRepository::class, VerifyIfEventIsStillActiveRepository::class],
            [IEventFindByIdRepository::class, EventFindByIdRepository::class],
            [IEventUpdateRepository::class, EventUpdateRepository::class],
            [IEventListRepository::class, EventListRepository::class],
            [IEventDetailsRepository::class, EventDetailsRepository::class],
            [IEventStopParticipatingRepository::class, EventStopParticipatingRepository::class],
            [IMyEventsListRepository::class, MyEventsListRepository::class],
            [IEventCancelRepository::class, EventCancelRepository::class],
            [IEventPrivateToParticipateRepository::class, EventPrivateToParticipateRepository::class],
            [IVerifyIfUserIsOrganizerEventRepository::class, VerifyIfUserIsOrganizerEventRepository::class],
        ];
    }
}
