<?php
namespace Service\Event;

use App\Core\Repository\Event\IEventFindByIdRepository;
use App\Core\Repository\Event\IEventUpdateRepository;
use App\Core\Service\Event\IEventUpdateService;
use App\Domain\Services\Event\EventUpdateService;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Models\EventAddress;
use App\Models\Events;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class EventUpdateServiceTest extends TestCase
{
    use WithFaker;

    private IEventUpdateService $sut;

    public function test_updateEvent_withValidData_returnsOk(): void
    {
        // Arrange
        $eventAddress = EventAddress::factory()->makeOne();
        $eventAddress->id = rand(1,100);
        $event = Events::factory()->makeOne(['id' => $eventAddress->event_id]);
        $event->setRelation('address', $eventAddress);
        $request = Mockery::mock(UpdateEventRequest::class);
        $request->eventId = $eventAddress->event_id;
        $request->name = $this->faker->name;
        $request->description = $this->faker->text;
        $request->type = 'Publica';
        $request->organizingCompany = $this->faker->company;
        $request->maxParticipants = rand(1,30);
        $request->durationTime = rand(1,5).' horas';
        $request->eventDate = $this->faker->date;
        $request->address = $this->faker->address;
        $request->city = $this->faker->city;
        $request->country = $this->faker->country;
        $request->state = $this->faker->state;
        $request->active = true;
        $eventRepository = Mockery::mock(IEventUpdateRepository::class);
        $eventRepositoryFindById = Mockery::mock(IEventFindByIdRepository::class);
        $eventRepositoryFindById->shouldReceive('eventFindById')
            ->once()
            ->with($request->eventId)
            ->andReturn($event);
        $eventRepository->shouldReceive('updateEvent')
            ->once()
            ->with($event)
            ->andReturn(true);
        $this->sut = new EventUpdateService($eventRepository, $eventRepositoryFindById);
        // Act
        $result = $this->sut->updateEvent($request);
        // Assert
        $this->assertTrue($result);
    }
}
