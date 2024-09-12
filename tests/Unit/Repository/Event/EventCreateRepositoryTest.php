<?php
namespace Repository\Event;

use App\Core\Repository\Event\IEventCreateRepository;
use App\Data\Event\EventCreateRepository;
use App\Http\Requests\Event\CreateEventRequest;
use App\Models\Events;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class EventCreateRepositoryTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    private IEventCreateRepository $sut;

    public function test_createEvent_withValidData_returnsOk(): void
    {
        //Arrange
        Events::factory()->createOne();
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
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
        $this->sut = new EventCreateRepository();
        //Act
        $result = $this->sut->createEvent($request);
        //Assert
        $this->assertInstanceOf(Events::class, $result);
        $this->assertDatabaseHas('events', [
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'organizing_company' => $request->organizingCompany,
            'max_participants' => $request->maxParticipants,
            'duration_time' => $request->durationTime,
            'event_date' => $request->eventDate,
        ]);
    }
}
