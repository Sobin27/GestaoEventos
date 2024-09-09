<?php
namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserConfirmedEmailTest extends TestCase
{
    use DatabaseTransactions;

    public function test_confirmedEmail_withValidData_returnsOk(): void
    {
        // Arrange
        $user = User::factory()->createOne();
        // Act
        $response = $this->put('/api/user/confirm/email/'.$user->uuid);
        // Assert
        $response->assertOk();
        $this->assertDatabaseHas('users', [
            'email_verified_at' => now(),
            'confirmed_email' => true
        ]);
    }
}
