<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IMyEventsListRepository;
use App\Core\Support\PaginatedList;
use App\Core\Support\Pagination;
use App\Http\Requests\Event\MyEventsRequest;
use App\Models\EventUser;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class MyEventsListRepository implements IMyEventsListRepository
{
    public function getMyEventsList(Pagination $pagination): PaginatedList
    {
        return PaginatedList::builderByEloquentPagination($this->query($pagination),$pagination);
    }
    private function query(Pagination $pagination): LengthAwarePaginator
    {
        return EventUser::query()->select([
            'e.id as id',
            'e.name as name',
            'e.type as type',
            'e.organizing_company as organizing_company',
            'e.active as active',
            'e.duration_time as duration_time',
            'e.event_date as event_date',
        ])
            ->selectSub(function (Builder $query) {
                $query->selectRaw('count(*)')
                    ->from('events_participants')
                    ->whereColumn('events_participants.event_id', 'e.id');
            }, 'participants_count')
            ->leftJoin('events as e', 'e.id', '=', 'events_participants.event_id')
            ->where('events_participants.participant_id', auth()->user()->id)
            ->paginate($pagination->perPage);
    }
}
