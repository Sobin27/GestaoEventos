<?php
namespace Service\Event;

use App\Core\Repository\Event\IEventDetailsRepository;
use App\Core\Service\Event\IEventDetailsService;
use App\Domain\Services\Event\EventDetailsService;
use App\Models\EventAddress;
use Mockery;
use Tests\TestCase;

class EventDetailsServiceTest extends TestCase
{
    private IEventDetailsService $sut;

    public function test_detailsEvent_returnsOk(): void
    {
        //Arrange
        $event = EventAddress::factory()->makeOne();
        $eventRepository = Mockery::mock(IEventDetailsRepository::class);
        $eventRepository->shouldReceive('getDetailsEvents')
            ->with($event->event_id)
            ->andReturn([]);
        $this->sut = new EventDetailsService($eventRepository);
        //Act
        $result = $this->sut->getDetailsEvents($event->event_id);
        //Assert
        $this->assertIsArray($result);
    }
}
