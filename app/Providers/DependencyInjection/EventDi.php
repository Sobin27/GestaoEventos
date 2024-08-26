<?php
namespace App\Providers\DependencyInjection;

use App\Core\Repository\Event\IEventCreateRepository;
use App\Core\Repository\Event\IEventFindByIdRepository;
use App\Core\Repository\Event\IEventToParticipateRepository;
use App\Core\Repository\Event\IEventUpdateRepository;
use App\Core\Repository\Event\IVerifyHowManyParticipantsEventRepository;
use App\Core\Repository\Event\IVerifyIfEventIsPublicRepository;
use App\Core\Repository\Event\IVerifyIfEventIsStillActiveRepository;
use App\Core\Service\Event\IEventCreateService;
use App\Core\Service\Event\IEventToParticipateService;
use App\Core\Service\Event\IEventUpdateService;
use App\Data\Event\EventCreateRepository;
use App\Data\Event\EventFindByIdRepository;
use App\Data\Event\EventToParticipateRepository;
use App\Data\Event\EventUpdateRepository;
use App\Data\Event\VerifyHowManyParticipantsEventRepository;
use App\Data\Event\VerifyIfEventIsPublicRepository;
use App\Data\Event\VerifyIfEventIsStillActiveRepository;
use App\Domain\Services\Event\EventCreateService;
use App\Domain\Services\Event\EventToParticipateService;
use App\Domain\Services\Event\EventUpdateService;

class EventDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [IEventCreateService::class, EventCreateService::class],
            [IEventToParticipateService::class, EventToParticipateService::class],
            [IEventUpdateService::class, EventUpdateService::class],
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
        ];
    }
}
