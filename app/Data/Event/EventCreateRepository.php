<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IEventCreateRepository;
use App\Http\Requests\Event\CreateEventRequest;
use App\Models\EventAddress;
use App\Models\Events;

class EventCreateRepository implements IEventCreateRepository
{
    public function createEvent(CreateEventRequest $request): bool
    {
        $event = Events::query()->create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'event_organizer' => auth()->user()->id,
            'organizing_company' => $request->organizingCompany,
            'max_participants' => $request->maxParticipants,
            'duration_time' => $request->durationTime,
            'event_date' => $request->eventDate,
            'created_at' => now(),
        ]);
        return $this->createEventAddress($event, $request);
    }
    private function createEventAddress(Events|null $event, CreateEventRequest $request): bool
    {
        $eventAddress = EventAddress::query()->create([
            'event_id' => $event->id,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'state' => $request->state,
        ]);
        if ($eventAddress) return true;
        return false;
    }
}
