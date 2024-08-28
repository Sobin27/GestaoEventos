<?php
namespace App\Core\Service\Event;

use App\Core\Support\PaginatedList;
use App\Http\Requests\Event\ListEventRequest;

interface IEventListService
{
    public function eventListPaginated(ListEventRequest $request): PaginatedList;
}
