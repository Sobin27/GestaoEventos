<?php
namespace Event;

use App\Mail\InviteUsersToPrivateEventMail;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EventCreateTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function test_createEvent_withValidData_returns200(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        Mail::fake();
        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'type' => 'Publica',
            'organizingCompany' => $this->faker->company,
            'maxParticipants' => rand(1,30),
            'durationTime' => rand(1,5).' horas',
            'eventDate' => $this->faker->date,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'state' => $this->faker->state,
        ];
        //Act
        $response = $this->post('api/event/create', $data);
        //Assert
        $response->assertStatus(201)
            ->assertJsonFragment([
                'message' => 'Event created successfully',
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
            'event_organizer' => $user->id,
            'active' => true,
        ]);
    }
    public function test_createEvent_isNotAuthenticate_returns401(): void
    {
        //Arrange
        $type = ['Publica', 'Privada'];
        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'type' => $type[array_rand($type)],
            'organizingCompany' => $this->faker->company,
            'maxParticipants' => rand(1,30),
            'durationTime' => rand(1,5).' horas',
            'eventDate' => $this->faker->date,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'state' => $this->faker->state,
        ];
        //Act
        $response = $this->post('api/event/create', $data);
        //Assert
        $response->assertStatus(401);
        $response->assertUnauthorized();
    }
    public function test_createEvent_withValidDataAndTypePrivate_returns200(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $users = User::factory()->count(3)->create();
        Mail::fake();
        $invitesUsers = [];
        foreach ($users as $invitedUser) {
            $invitesUsers[] = $invitedUser->id;
        }
        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'type' => 'Privada',
            'organizingCompany' => $this->faker->company,
            'maxParticipants' => rand(1,30),
            'durationTime' => rand(1,5).' horas',
            'eventDate' => $this->faker->date,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'state' => $this->faker->state,
            'invitesUsers' => $invitesUsers,
        ];
        //Act
        $response = $this->post('api/event/create', $data);
        //Assert
        $response->assertStatus(201)
            ->assertJsonFragment([
                'message' => 'Event created successfully',
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
            'event_organizer' => $user->id,
            'active' => 1,
        ]);
        foreach ($users as $invitedUsersEmail){
            Mail::assertSent(function (InviteUsersToPrivateEventMail $mail) use ($invitedUsersEmail) {
                return $mail->hasTo($invitedUsersEmail->email);
            });
        }
    }
}
