<?php
namespace App\Domain\Services\Event;

use App\Core\Repository\Event\IEventListRepository;
use App\Core\Service\Event\IEventListService;
use App\Core\Support\PaginatedList;
use App\Http\Requests\Event\ListEventRequest;

class EventListService implements IEventListService
{
    public function __construct(
        private readonly IEventListRepository $eventListRepository
    )
    { }

    public function eventListPaginated(ListEventRequest $request): PaginatedList
    {
        return $this->eventListRepository->eventListPaginated($request->getPagination(), $request);
    }
}
