<?php
namespace Event;

use App\Models\EventAddress;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EventDetailsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_detailsEvents_returns200(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $event = EventAddress::factory(10)->create()->random();
        //Act
        $response = $this->json('GET', 'api/event/details/' . $event->event_id);
        //Assert
        $response->assertStatus(200);
        $this->assertIsArray($response->json()['data']);
    }
}
