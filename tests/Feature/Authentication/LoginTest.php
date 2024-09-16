<?php
namespace Authentication;

use App\Models\User;
use App\Models\UserPassword;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function test_login_withValidData_returns200(): void
    {
        //Arrange
        $password = $this->faker->password();
        $userPassword = UserPassword::factory()->createOne(['password' => Hash::make($password)]);
        $user = User::query()->where('id', $userPassword->user_id)->first();
        $data = [
            'login' => $user->login,
            'password' => $password,
        ];
        // Act
        $response = $this->post('api/authentication/login', $data);
        // Assert
        $response->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'Login successfully',
                'data' => [
                    'Name' => $user->name,
                    'Email' => $user->email,
                    'Token' => $response->baseResponse->original['data']['Token']
                ]
            ]);
    }
    public function test_login_withInvalidData_returns400(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $data = [
            'login' => $user->login,
            'password' => $this->faker->password(),
        ];
        // Act
        $response = $this->post('api/authentication/login', $data);
        // Assert
        $response->assertStatus(400);
    }
}
