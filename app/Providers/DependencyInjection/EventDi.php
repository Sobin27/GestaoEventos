<?php
namespace App\Providers\DependencyInjection;

use App\Core\Repository\Event\IEventCreateRepository;
use App\Core\Service\Event\IEventCreateService;
use App\Data\Event\EventCreateRepository;
use App\Domain\Services\Event\EventCreateService;

class EventDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [IEventCreateService::class, EventCreateService::class],
        ];
    }
    protected function repositories(): array
    {
        return [
            [IEventCreateRepository::class, EventCreateRepository::class],
        ];
    }
}
