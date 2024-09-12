<?php
namespace Event;

use App\Models\Events;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EventToParticipateTest extends TestCase
{
    use DatabaseTransactions;

    public function test_eventToParticipate_withValidData_returns200(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $event = Events::factory()->createOne(['type' => 'Publica', 'active' => true]);
        //Act
        $response = $this->post('api/event/to-participate/' . $event->id);
        //Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('events_participants', [
            'event_id' => $event->id,
            'participant_id' => $user->id
        ]);
    }
    public function test_eventToParticipate_withValidData_butTheEventIsNotPublic_returns400(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $event = Events::factory()->createOne(['type' => 'Privada', 'active' => true]);
        //Act
        $response = $this->post('api/event/to-participate/' . $event->id);
        //Assert
        $response->assertStatus(500);
    }
    public function test_eventToParticipate_withValidData_butTheEventIsNotActive_returns400(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $event = Events::factory()->createOne(['type' => 'Publica', 'active' => false]);
        //Act
        $response = $this->post('api/event/to-participate/' . $event->id);
        //Assert
        $response->assertStatus(500);
    }
    public function test_eventToParticipate_withValidData_butTheEventIsNotVacancies_returns400(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $event = Events::factory()->createOne(['type' => 'Publica', 'active' => false, 'max_participants' => 5]);
        EventUser::factory(5)->create(['event_id' => $event->id]);
        //Act
        $response = $this->post('api/event/to-participate/' . $event->id);
        //Assert
        $response->assertStatus(500);
    }
}
