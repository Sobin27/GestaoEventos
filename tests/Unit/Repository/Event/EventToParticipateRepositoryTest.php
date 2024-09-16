<?php
namespace Repository\Event;

use App\Core\Repository\Event\IEventToParticipateRepository;
use App\Data\Event\EventToParticipateRepository;
use App\Models\Events;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EventToParticipateRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private IEventToParticipateRepository $sut;

    public function test_participateToEvent_withValidData_returnsTrue(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $event = Events::factory()->createOne();
        $this->sut = new EventToParticipateRepository();
        //Act
        $result = $this->sut->toParticipateEvent($event->id);
        //Assert
        $this->assertTrue($result);
        $this->assertDatabaseHas('events_participants', [
            'event_id' => $event->id,
            'participant_id' => $user->id
        ]);
    }
}
