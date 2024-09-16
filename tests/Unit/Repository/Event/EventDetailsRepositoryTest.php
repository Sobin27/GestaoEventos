<?php
namespace Repository\Event;

use App\Core\Repository\Event\IEventDetailsRepository;
use App\Data\Event\EventDetailsRepository;
use App\Models\EventAddress;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EventDetailsRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private IEventDetailsRepository $sut;
    public function test_detailsEvents_returnsOk(): void
    {
        //Arrange
        $event = EventAddress::factory()->createOne();
        $this->sut = new EventDetailsRepository();
        //Act
        $result = $this->sut->getDetailsEvents($event->event_id);
        //Assert
        $this->assertIsArray($result);
    }
}
