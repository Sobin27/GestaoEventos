<?php
namespace App\Core\Repository\Event;

use App\Core\Support\PaginatedList;
use App\Core\Support\Pagination;
use App\Http\Requests\Event\MyEventsRequest;

interface IMyEventsListRepository
{
    public function getMyEventsList(Pagination $pagination): PaginatedList;
}
