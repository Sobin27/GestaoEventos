<?php
namespace Service\User;

use App\Core\Repository\User\IUserConfirmedEmailRepository;
use App\Core\Service\User\IUserConfirmEmailService;
use App\Domain\Services\User\UserConfirmEmailService;
use App\Models\User;
use Mockery;
use Tests\TestCase;

class UserConfirmedEmailServiceTest extends TestCase
{
    private IUserConfirmEmailService $sut;

    public function test_confirmedEmail_withValidData_returnsOk()
    {
        //Arrange
        $user = User::factory()->makeOne();
        $userRepository = Mockery::mock(IUserConfirmedEmailRepository::class);
        $userRepository->shouldReceive('confirmEmail')
            ->with((string)$user->uuid)
            ->andReturn(true);
        $this->sut = new UserConfirmEmailService($userRepository);
        //Act
        $result = $this->sut->confirmEmail($user->uuid);
        //Assert
        $this->assertTrue($result);
    }
}
