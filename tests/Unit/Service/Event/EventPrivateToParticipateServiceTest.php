<?php
namespace Service\Event;

use App\Core\Repository\Event\IEventPrivateToParticipateRepository;
use App\Core\Service\Event\IEventPrivateToParticipateService;
use App\Domain\Services\Event\EventPrivateToParticipateService;
use App\Models\EventAddress;
use App\Models\User;
use Mockery;
use Tests\TestCase;

class EventPrivateToParticipateServiceTest extends TestCase
{
    private IEventPrivateToParticipateService $sut;

    public function test_eventPrivateToParticipate_returnsOk(): void
    {
        //Arrange
        $user = User::factory()->makeOne();
        $user->id = rand(1, 100);
        $event = EventAddress::factory()->makeOne();
        $event->event->type = 'Privada';
        $eventRepository = Mockery::mock(IEventPrivateToParticipateRepository::class);
        $eventRepository->shouldReceive('participateToPrivateEvent')
            ->once()
            ->andReturn($event->event_id, $user->id);
        $this->sut = new EventPrivateToParticipateService($eventRepository);
        //Act
        $result = $this->sut->participateToPrivateEvent($event->event_id, $user->id);
        //Assert
        $this->assertTrue($result);
    }
}
