<?php
namespace App\Providers\DependencyInjection;

use App\Core\Repository\Event\IEventCreateRepository;
use App\Core\Repository\Event\IEventToParticipateRepository;
use App\Core\Repository\Event\IVerifyHowManyParticipantsEventRepository;
use App\Core\Repository\Event\IVerifyIfEventIsPublicRepository;
use App\Core\Repository\Event\IVerifyIfEventIsStillActiveRepository;
use App\Core\Service\Event\IEventCreateService;
use App\Core\Service\Event\IEventToParticipateService;
use App\Data\Event\EventCreateRepository;
use App\Data\Event\EventToParticipateRepository;
use App\Data\Event\VerifyHowManyParticipantsEventRepository;
use App\Data\Event\VerifyIfEventIsPublicRepository;
use App\Data\Event\VerifyIfEventIsStillActiveRepository;
use App\Domain\Services\Event\EventCreateService;
use App\Domain\Services\Event\EventToParticipateService;

class EventDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [IEventCreateService::class, EventCreateService::class],
            [IEventToParticipateService::class, EventToParticipateService::class],
        ];
    }
    protected function repositories(): array
    {
        return [
            [IEventCreateRepository::class, EventCreateRepository::class],
            [IVerifyHowManyParticipantsEventRepository::class, VerifyHowManyParticipantsEventRepository::class],
            [IVerifyIfEventIsPublicRepository::class, VerifyIfEventIsPublicRepository::class],
            [IEventToParticipateRepository::class, EventToParticipateRepository::class],
            [IVerifyIfEventIsStillActiveRepository::class, VerifyIfEventIsStillActiveRepository::class]
        ];
    }
}
