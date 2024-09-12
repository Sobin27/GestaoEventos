<?php
namespace Service\Event;

use App\Core\Repository\Event\IEventStopParticipatingRepository;
use App\Core\Service\Event\IEventStopParticipatingService;
use App\Domain\Services\Event\EventStopParticipatingService;
use App\Models\EventUser;
use App\Models\User;
use Mockery;
use Tests\TestCase;

class EventStopParticipatingServiceTest extends TestCase
{
    private IEventStopParticipatingService $sut;

    public function test_stopParticipatingEvent_returnsOk(): void
    {
        //Arrange
        $user = User::factory()->makeOne();
        $user->id = rand(1,100);
        $this->actingAs($user, 'jwt');
        $eventUser = EventUser::factory()->makeOne();
        $eventRepository = Mockery::mock(IEventStopParticipatingRepository::class);
        $eventRepository->shouldReceive('stopParticipating')
            ->with($eventUser->event_id)
            ->andReturn(true);
        $this->sut = new EventStopParticipatingService($eventRepository);
        //Act
        $result = $this->sut->stopParticipating($eventUser->event_id);
        //Assert
        $this->assertTrue($result);
    }
}
