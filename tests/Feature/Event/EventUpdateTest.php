<?php
namespace Event;

use App\Models\EventAddress;
use App\Models\Events;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventUpdateTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function test_updateEvent_withValidData_returns200(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $eventAddres = EventAddress::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $data = [
            'eventId' => $eventAddres->event_id,
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'type' => 'Publica',
            'organizingCompany' => $this->faker->company,
            'maxParticipants' => rand(1,30),
            'durationTime' => rand(1,5).' horas',
            'eventDate' => $this->faker->date,
            'active' => true,
        ];
        //Act
        $response = $this->put('api/event/update', $data);
        //Assert
        $response->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'Event updated successfully',
                'data' => true
            ]);
        $this->assertDatabaseHas('events', [
            'name' => $data['name'],
            'description' => $data['description'],
            'type' => $data['type'],
            'organizing_company' => $data['organizingCompany'],
            'max_participants' => $data['maxParticipants'],
            'duration_time' => $data['durationTime'],
            'event_date' => $data['eventDate'],
            'active' => $data['active'],
        ]);
    }
    public function test_updateEvent_withUserUnauthorized_returns200(): void
    {
        //Arrange
        $eventAddres = EventAddress::factory()->createOne();
        $data = [
            'eventId' => $eventAddres->event_id,
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'type' => 'Publica',
            'organizingCompany' => $this->faker->company,
            'maxParticipants' => rand(1,30),
            'durationTime' => rand(1,5).' horas',
            'eventDate' => $this->faker->date,
            'active' => true,
        ];
        //Act
        $response = $this->put('api/event/update', $data);
        //Assert
        $response->assertStatus(401);
    }
}
