<?php
namespace Event;

use App\Models\EventUser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MyEventsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_listMyEvents_returns200(): void
    {
        // Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $count = rand(1, 10);
        EventUser::factory($count)->create(['participant_id' => $user->id]);
        // Act
        $response = $this->get('api/event/my-events?page=1&perPage=10');
        // Assert
        $response->assertStatus(200);
        $this->assertCount($count, $response->json('data')['list']);
    }
}
