<?php
namespace Repository\Event;

use App\Core\Repository\Event\IEventStopParticipatingRepository;
use App\Data\Event\EventStopParticipatingRepository;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EventStopParticipatingRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private IEventStopParticipatingRepository $sut;

    public function test_stopParticipatingEvent_returnsOk(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $eventUser = EventUser::factory()->createOne(['participant_id' => $user->id]);
        $this->sut = new EventStopParticipatingRepository();
        //Act
        $result = $this->sut->stopParticipating($eventUser->event_id);
        //Assert
        $this->assertTrue($result);
        $this->assertDatabaseMissing('events_participants', [
            'participant_id' => $user->id
        ]);
    }
}
