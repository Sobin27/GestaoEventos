<?php
namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserUpdateTest extends TestCase
{
    use DatabaseTransactions,WithFaker;

    public function test_updateUser_withValidData_returnsOk()
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        $userRequest = [
            'uuid' => (string)$user->uuid,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
        ];
        //Act
        $response = $this->put('api/user/update', $userRequest);
        //Assert
        $response->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'User updated successfully',
                'data' => true
            ]);
        $this->assertDatabaseHas('users', [
            'name' => $userRequest['name'],
            'email' => $userRequest['email'],
        ]);
    }
    public function test_updateUser_withEmailAlreadyExists_returns400(): void
    {
        //Arrange
        $user1 = User::factory()->createOne();
        $user2 = User::factory()->createOne();
        $this->actingAs($user1, 'jwt');
        $userRequest = [
            'uuid' => (string)$user1->uuid,
            'name' => $this->faker->name,
            'email' => $user2->email,
        ];
        //Act
        $response = $this->put('api/user/update', $userRequest);
        //Assert
        $response->assertStatus(400)
            ->assertJsonFragment([
                'message' => 'Email already exists',
            ]);
    }
    public function test_updateUser_withLoginAlreadyExists_returns400(): void
    {
        //Arrange
        $user1 = User::factory()->createOne();
        $user2 = User::factory()->createOne();
        $this->actingAs($user1, 'jwt');
        $userRequest = [
            'uuid' => (string)$user1->uuid,
            'name' => $this->faker->name,
            'login' => $user2->login,
        ];
        //Act
        $response = $this->put('api/user/update', $userRequest);
        //Assert
        $response->assertStatus(400)
            ->assertJsonFragment([
                'message' => 'Login already exists',
            ]);
    }
}
