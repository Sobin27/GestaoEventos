<?php
namespace Event;

use App\Models\EventAddress;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EventPrivateToParticipateTest extends TestCase
{
    use DatabaseTransactions;

    public function test_eventPrivateToParticipate_returns200(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $event = EventAddress::factory()->createOne();
        $event->event->type = 'Privada';
        //Act
        $response = $this->post('api/event/participate-private/'.$event->event_id.'/'.$user->id);
        //Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('events_participants', [
            'participant_id' => $user->id,
            'event_id' => $event->event_id
        ]);
    }
}
