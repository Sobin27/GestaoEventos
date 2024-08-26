<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IVerifyHowManyParticipantsEventRepository;
use App\Models\Events;

class VerifyHowManyParticipantsEventRepository implements IVerifyHowManyParticipantsEventRepository
{
    public function verifyHoManyParticipants(int $eventId): array
    {
        return Events::query()
            ->select(['max_participants'])
            ->selectSub(function ($query) {
                $query->from('events_participants as ep')
                    ->whereColumn('ep.event_id', 'events.id')
                    ->selectRaw('count(*)');
            }, 'participants')
            ->where('events.id', $eventId)
            ->get()
            ->toArray();
    }
}
