<?php
namespace Repository\Event;

use App\Core\Repository\Event\IEventPrivateToParticipateRepository;
use App\Data\Event\EventPrivateToParticipateRepository;
use App\Models\EventAddress;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EventPrivateToParticipateRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private IEventPrivateToParticipateRepository $sut;

    public function test_eventPrivateToParticipate_returnsOk(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $event = EventAddress::factory()->createOne();
        $event->event->type = 'Privada';
        $this->sut = new EventPrivateToParticipateRepository();
        //Act
        $result = $this->sut->participateToPrivateEvent($event->event->id, $user->id);
        //Assert
        $this->assertTrue($result);
        $this->assertDatabaseHas('events_participants', [
            'event_id' => $event->event->id,
            'participant_id' => $user->id
        ]);
    }
}
