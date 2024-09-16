<?php
namespace Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use DatabaseTransactions;

    public function test_logout_withValidData_returns200(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        //Act
        $response = $this->post('api/authentication/logout');
        //Assert
        $response->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'Logout successfully',
                'data' => true,
            ]);
    }
}
