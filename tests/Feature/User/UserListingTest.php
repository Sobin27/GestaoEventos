<?php
namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class UserListingTest extends TestCase
{
    use DatabaseTransactions;

    public function test_getUsers_returns200(): void
    {
        // Arrange
        Mail::fake();
        User::query()->delete();
        $user = User::factory(5)->create();
        $this->actingAs($user->first(), 'jwt');
        // Act
        $response = $this->get('/api/user/list');
        // Assert
        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
        $response->assertJsonFragment([
            'message' => 'Users listed successfully',
        ]);
        foreach ($user as $u) {
            $response->assertJsonFragment([
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
            ]);
        }
    }
    public function test_getUsers_withFilterName_returns200(): void
    {
        // Arrange
        Mail::fake();
        User::query()->delete();
        $user = User::factory(5)->create();
        $userFilter = $user->first();
        $this->actingAs($userFilter->first(), 'jwt');
        // Act
        $response = $this->json('GET', '/api/user/list', ['name' => $userFilter->name]);
        // Assert
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment([
            'message' => 'Users listed successfully',
        ]);
        $response->assertJsonFragment([
            'id' => $userFilter->id,
            'name' => $userFilter->name,
            'email' => $userFilter->email,
        ]);
    }
    public function test_getUsers_withFilterEmail_returns200(): void
    {
        // Arrange
        Mail::fake();
        User::query()->delete();
        $user = User::factory(5)->create();
        $userFilter = $user->first();
        $this->actingAs($userFilter->first(), 'jwt');
        // Act
        $response = $this->json('GET', '/api/user/list', ['email' => $userFilter->email]);
        // Assert
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment([
            'message' => 'Users listed successfully',
        ]);
        $response->assertJsonFragment([
            'id' => $userFilter->id,
            'name' => $userFilter->name,
            'email' => $userFilter->email,
        ]);
    }
}
