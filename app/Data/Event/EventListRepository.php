<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IEventListRepository;
use App\Core\Support\PaginatedList;
use App\Core\Support\Pagination;
use App\Http\Requests\Event\ListEventRequest;
use App\Models\Events;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class EventListRepository implements IEventListRepository
{
    public function eventListPaginated(Pagination $pagination, ListEventRequest $request): PaginatedList
    {
        return PaginatedList::builderByEloquentPagination($this->query($pagination, $request),$pagination);
    }
    private function query(Pagination $pagination, ListEventRequest $request): LengthAwarePaginator
    {
        return Events::query()->select(['events.*', 'u.name as event_organizer_name'])
            ->selectSub(function (Builder $query) {
                $query->selectRaw('count(*)')
                    ->from('events_participants')
                    ->whereColumn('events_participants.event_id', 'events.id');
            }, 'participants_count')
            ->leftJoin('events_participants as ep', 'ep.event_id', '=', 'events.id')
            ->join('users as u', 'u.id', '=', 'events.event_organizer')
            ->where($this->filter($request))
            ->paginate($pagination->perPage);
    }
    private function filter(ListEventRequest $request): array
    {
        $filter = [];
        if (isset($request->type)) {
            $filter[] = ['events.type', '=', $request->type];
        }
        if (isset($request->active)) {
            $filter[] = ['events.active', '=', $request->active];
        }
        if (isset($request->name)){
            $filter[] = ['events.name', 'like', '%'.$request->name.'%'];
        }
        return $filter;
    }
}
