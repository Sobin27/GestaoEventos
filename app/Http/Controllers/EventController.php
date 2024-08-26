<?php
namespace App\Http\Controllers;


use App\Core\Service\Event\IEventCreateService;
use App\Core\Service\Event\IEventToParticipateService;
use App\Core\Service\Event\IEventUpdateService;
use App\Http\Requests\Event\CreateEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    public function __construct(
        private readonly IEventCreateService $eventCreateService,
        private readonly IEventToParticipateService $eventToParticipateService,
        private readonly IEventUpdateService $eventUpdateService,
    )
    { }

    public function createEvent(CreateEventRequest $request): Response
    {
        try {
            return $this->response(
                message: 'Event created successfully',
                data: $this->eventCreateService->createEvent($request),
                code: 201
            );
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function toParticipateEvent(int $eventId): Response
    {
        try {
            return $this->response(
              message: 'Event to participate successfully',
              data: $this->eventToParticipateService->eventToParticipate($eventId),
              code: 201
            );
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function updateEvent(UpdateEventRequest $request): Response
    {
        try {
            return $this->response(
                message: 'Event updated successfully',
                data: $this->eventUpdateService->updateEvent($request),
                code: 200
            );
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
