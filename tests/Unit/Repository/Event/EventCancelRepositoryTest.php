<?php
namespace Repository\Event;

use App\Core\Repository\Event\IEventCancelRepository;
use App\Data\Event\EventCancelRepository;
use App\Models\Events;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EventCancelRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private IEventCancelRepository $sut;

    public function test_cancelEvent_withValidData_returnsOk(): void
    {
        //Arrange
        $event = Events::factory()->createOne();
        $this->sut = new EventCancelRepository();
        //Act
        $result = $this->sut->cancelEvent($event->id);
        //Assert
        $this->assertTrue($result);
        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'active' => false
        ]);
    }
}
