<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IEventDetailsRepository;
use App\Models\Events;
use Illuminate\Database\Query\Builder;

class EventDetailsRepository implements IEventDetailsRepository
{
    public function getDetailsEvents(int $eventId): array
    {
        return Events::query()->select([
                "events.name as event_name",
                "events.description as event_description",
                "events.type as event_type",
                "u.name as event_organizer",
                "events.active as event_active",
                "events.duration_time as event_duration",
                "events.event_date as event_date",
                "ea.address as event_address",
                "ea.city as event_city",
                "ea.state as event_state",
                "ea.country as event_country"
            ])
            ->selectSub(function (Builder $query) {
                $query->selectRaw('count(*)')
                    ->from('events_participants')
                    ->whereColumn('events_participants.event_id', 'events.id');
            }, 'participants_count')
            ->join('events_address as ea', 'events.id', '=', 'ea.event_id')
            ->join('users as u', 'events.event_organizer', '=', 'u.id')
            ->leftJoin('events_participants as ep', 'ep.event_id', '=', 'events.id')
            ->where('events.id', $eventId)
            ->get()[0]->mapTo();
    }
}
