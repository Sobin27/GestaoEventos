<?php
namespace Event;

use App\Models\EventAddress;
use App\Models\Events;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventListTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function test_listEvents_returns200(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        EventAddress::factory(20)->create();
        //Act
        $response = $this->getJson('/api/event/list?page=1&perPage=10');
        //Assert
        $response->assertStatus(200);
        $this->assertCount(10, $response->json('data')['list']);
    }
    public function test_listEvents_withFilterForName_returns200(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $eventAddress = EventAddress::factory(20)->create()->random();
        $event = Events::where('id', $eventAddress->event_id)->first();
        $data = [
            'name' => $event->name,
        ];
        //Act
        $response = $this->json('GET','/api/event/list?page=1&perPage=10', $data);
        //Assert
        $response->assertStatus(200);
        $this->assertCount(1, $response->json('data')['list']);
    }
    public function test_listEvents_withFilterForType_returns200(): void
    {
        //Arrange
        EventAddress::truncate();
        Events::truncate();
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        EventAddress::factory(10)->create()->random();
        $type = $this->faker->randomElement(['Privada', 'Publica']);
        $event = Events::where('type', '=', $type)->count();
        $data = [
            'type' => $type,
        ];
        //Act
        $response = $this->json('GET','/api/event/list?page=1&perPage=10', $data);
        //Assert
        $response->assertStatus(200);
        $this->assertCount($event, $response->json('data')['list']);
    }
    public function test_listEvents_withUserUnauthorized_returns401(): void
    {
        //Arrange
        EventAddress::factory(20)->create();
        //Act
        $response = $this->getJson('/api/event/list?page=1&perPage=10');
        //Assert
        $response->assertStatus(401);
    }
}
