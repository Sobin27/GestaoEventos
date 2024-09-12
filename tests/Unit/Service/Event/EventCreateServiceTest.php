<?php
namespace Service\Event;

use App\Core\Repository\Event\IEventCreateRepository;
use App\Core\Service\Event\IEventCreateService;
use App\Domain\Services\Event\EventCreateService;
use App\Http\Requests\Event\CreateEventRequest;
use App\Models\Events;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class EventCreateServiceTest extends TestCase
{
    use WithFaker;

    private IEventCreateService $sut;

    public function test_createEvent_withValidData_returnsOk(): void
    {
        //Arrange
        $event = Events::factory()->makeOne();
        $request = Mockery::mock(CreateEventRequest::class);
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
        $request->invitesUsers = [];
        $eventRepository = Mockery::mock(IEventCreateRepository::class);
        $eventRepository->shouldReceive('createEvent')
            ->once()
            ->with($request)
            ->andReturn($event);
        $this->sut = new EventCreateService($eventRepository);
        //Act
        $result = $this->sut->createEvent($request);
        //Assert
        $this->assertTrue($result);
    }
}
