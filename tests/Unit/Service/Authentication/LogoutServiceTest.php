<?php
namespace Service\Authentication;

use App\Core\Repository\Login\ILogoutRepository;
use App\Core\Service\Login\ILogoutService;
use App\Domain\Services\Login\LogoutService;
use App\Models\User;
use Mockery;
use Tests\TestCase;

class LogoutServiceTest extends TestCase
{
    private ILogoutService $sut;

    public function test_logout_withValidData_returnsOk(): void
    {
        //Arrange
        $logoutRepository = Mockery::mock(ILogoutRepository::class);
        $logoutRepository->shouldReceive('logout')
            ->once()
            ->andReturn(true);
        $this->sut = new LogoutService($logoutRepository);
        //Act
        $result = $this->sut->logout();
        //Assert
        $this->assertTrue($result);
    }
}
