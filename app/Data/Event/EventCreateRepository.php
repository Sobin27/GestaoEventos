<?php
namespace App\Data\Event;

use App\Core\Repository\Event\IEventCreateRepository;
use App\Http\Requests\Event\CreateEventRequest;
use App\Models\EventAddress;
use App\Models\Events;
use Exception;

class EventCreateRepository implements IEventCreateRepository
{
    public function createEvent(CreateEventRequest $request): Events
    {
        try {
            return Events::query()->create([
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
        }catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
    private function createEventAddress(Events|null $event, CreateEventRequest $request): void
    {
        try {
            EventAddress::query()->create([
                'event_id' => $event->id,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'state' => $request->state,
            ]);
        }catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
