<?php
namespace App\Http\Controllers;


use App\Core\Service\Event\IEventCancelService;
use App\Core\Service\Event\IEventCreateService;
use App\Core\Service\Event\IEventDetailsService;
use App\Core\Service\Event\IEventListService;
use App\Core\Service\Event\IEventStopParticipatingService;
use App\Core\Service\Event\IEventToParticipateService;
use App\Core\Service\Event\IEventUpdateService;
use App\Core\Service\Event\IMyEventsListService;
use App\Http\Requests\Event\CreateEventRequest;
use App\Http\Requests\Event\ListEventRequest;
use App\Http\Requests\Event\MyEventsRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    public function __construct(
        private readonly IEventCreateService $eventCreateService,
        private readonly IEventToParticipateService $eventToParticipateService,
        private readonly IEventUpdateService $eventUpdateService,
        private readonly IEventListService $eventListService,
        private readonly IEventDetailsService $eventDetailsService,
        private readonly IEventStopParticipatingService $eventStopParticipatingService,
        private readonly IMyEventsListService $myEventsListService,
        private readonly IEventCancelService $eventCancelService,
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
    public function listEvent(ListEventRequest $request): Response
    {
        try {
            return $this->response(
                message: 'Event list successfully',
                data: $this->eventListService->eventListPaginated($request),
                code: 200
            );
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function detailsEvent(int $eventId): Response
    {
        try {
            return $this->response(
                message: 'Event details list successfully',
                data: $this->eventDetailsService->getDetailsEvents($eventId),
                code: 200
            );
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function eventStopParticipating(int $eventId): Response
    {
        try {
            return $this->response(
                message: 'Stop participating event successfully',
                data: $this->eventStopParticipatingService->stopParticipating($eventId),
                code: 200
            );
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function myEventsList(MyEventsRequest $request): Response
    {
        try {
            return $this->response(
                message: 'My events listing successfully',
                data: $this->myEventsListService->getMyEventsList($request),
                code: 200
            );
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function cancelEvent(int $eventId): Response
    {
        try {
            return $this->response(
                message: 'Event canceled successfully',
                data: $this->eventCancelService->cancelEvent($eventId),
                code: 200
            );
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
