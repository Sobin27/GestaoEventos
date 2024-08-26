<?php
namespace App\Http\Controllers;


use App\Core\Service\Event\IEventCreateService;
use App\Http\Requests\Event\CreateEventRequest;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    public function __construct(
        private readonly IEventCreateService $eventCreateService
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
}
