<?php
namespace Repository\User;

use App\Core\Repository\User\IUserConfirmedEmailRepository;
use App\Data\User\UserConfirmedEmailRepository;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserConfirmedEmailRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private IUserConfirmedEmailRepository $sut;

    public function test_confirmedEmail_withValidData_returnsTrue(): void
    {
        // Arrange
        $user = User::factory()->createOne();
        $this->sut = new UserConfirmedEmailRepository();
        // Act
        $result = $this->sut->confirmEmail((string)$user->uuid);
        // Assert
        $this->assertTrue($result);
    }
}
