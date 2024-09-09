<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCreateTest extends TestCase
{
    use DatabaseTransactions, withFaker;

    public function test_createUser_withValidData_returnsOk(): void
    {
        //Arrange
        $userRequest = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'login' => $this->faker->userName,
            'password' => $this->faker->password,
        ];
        //Act
        $response = $this->post('api/user/create', $userRequest);
        //Assert
        $response->assertStatus(201)
            ->assertJsonFragment([
               'message' => 'User created successfully',
               'data' => true
            ]);
        $this->assertDatabaseHas('users', [
            'name' => $userRequest['name'],
            'email' => $userRequest['email'],
            'login' => $userRequest['login'],
        ]);
    }
    public function test_createUser_withEmailAlreadyExists_returns400(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $userRequest = [
            'name' => $this->faker->name,
            'email' => $user->email,
            'login' => $this->faker->userName,
            'password' => $this->faker->password,
        ];
        //Act
        $response = $this->post('api/user/create', $userRequest);
        //Assert
        $response->assertStatus(400)
            ->assertJsonFragment([
                'message' => 'Email already exists',
            ]);
    }
    public function test_createUser_withLoginAlreadyExists_returns400(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $userRequest = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'login' => $user->login,
            'password' => $this->faker->password,
        ];
        //Act
        $response = $this->post('api/user/create', $userRequest);
        //Assert
        $response->assertStatus(400)
            ->assertJsonFragment([
                'message' => 'Login already exists',
            ]);
    }
}
