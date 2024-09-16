<?php
namespace Event;

use App\Models\Events;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EventCancelTest extends TestCase
{
    use DatabaseTransactions;

    public function test_cancelEvent_returns200(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $event = Events::factory()->createOne(['event_organizer' => $user->id, 'active' => true]);
        //Act
        $response = $this->post("/api/event/cancel/". $event->id);
        //Assert
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Event canceled successfully',
                'data' => true
            ]);
        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'active' => false
        ]);
    }
    public function test_cancelEvent_withUserIsNotOrganizer_return400(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $event = Events::factory()->createOne();
        //Act
        $response = $this->post("/api/event/cancel/". $event->id);
        //Assert
        $response->assertStatus(500)
            ->assertJson([
                'message' => 'You are not the organizer of this event'
            ]);
    }
    public function test_cancelEvent_withUserUnauthorized_return401(): void
    {
        //Arrange
        $event = Events::factory()->createOne();
        //Act
        $response = $this->post("/api/event/cancel/". $event->id);
        //Assert
        $response->assertStatus(401);
    }
}
