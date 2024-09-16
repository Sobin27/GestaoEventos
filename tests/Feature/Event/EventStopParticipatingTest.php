<?php
namespace Event;

use App\Models\EventUser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EventStopParticipatingTest extends TestCase
{
    use DatabaseTransactions;

    public function test_stopParticipatingEvent_returns200(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $eventUsers = EventUser::factory()->createOne(['participant_id' => $user->id]);
        //Act
        $response = $this->delete('api/event/stop-participating/' . $eventUsers->event_id);
        //Assert
        $response->assertStatus(200);
        $this->assertDatabaseMissing('events_participants', [
            'participant_id' => $user->id
        ]);
    }
}
