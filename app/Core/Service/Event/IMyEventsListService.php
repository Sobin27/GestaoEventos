<?php
namespace App\Core\Service\Event;

use App\Core\Support\PaginatedList;
use App\Http\Requests\Event\MyEventsRequest;

interface IMyEventsListService
{
    public function getMyEventsList(MyEventsRequest $request): PaginatedList;
}
