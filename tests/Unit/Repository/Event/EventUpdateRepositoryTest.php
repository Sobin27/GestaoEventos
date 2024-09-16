<?php
namespace Repository\Event;

use App\Core\Repository\Event\IEventUpdateRepository;
use App\Data\Event\EventUpdateRepository;
use App\Models\EventAddress;
use App\Models\Events;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EventUpdateRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private IEventUpdateRepository $sut;

    public function test_updateEvent_withValidData_returnsOk(): void
    {
        //Arrange
        $eventAddress = EventAddress::factory()->createOne();
        $event = Events::where('id', $eventAddress->event_id)->first();
        $this->sut = new EventUpdateRepository();
        //Act
        $result = $this->sut->updateEvent($event);
        //Assert
        $this->assertTrue($result);
    }
}
