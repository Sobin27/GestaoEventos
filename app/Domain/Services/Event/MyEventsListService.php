<?php
namespace App\Domain\Services\Event;

use App\Core\Repository\Event\IMyEventsListRepository;
use App\Core\Service\Event\IMyEventsListService;
use App\Core\Support\PaginatedList;
use App\Http\Requests\Event\MyEventsRequest;

class MyEventsListService implements IMyEventsListService
{
    public function __construct(
        private readonly IMyEventsListRepository $myEventsListRepository
    )
    { }

    public function getMyEventsList(MyEventsRequest $request): PaginatedList
    {
        return $this->myEventsListRepository->getMyEventsList($request->getPagination());
    }
}
