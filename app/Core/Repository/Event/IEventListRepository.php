<?php
namespace App\Core\Repository\Event;

use App\Core\Support\PaginatedList;
use App\Core\Support\Pagination;
use App\Http\Requests\Event\ListEventRequest;

interface IEventListRepository
{
    public function eventListPaginated(Pagination $pagination, ListEventRequest $request): PaginatedList;
}
