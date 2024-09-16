<?php
namespace Service\Authentication;

use App\Core\Service\Login\ILogoutService;
use App\Domain\Services\Login\LogoutService;
use App\Models\User;
use Tests\TestCase;

class LogoutServiceTest extends TestCase
{
    private ILogoutService $sut;

    public function test_logout_withValidData_returnsOk(): void
    {
        //Arrange
        $this->actingAs(User::factory()->createOne(), 'jwt');
        $this->sut = new LogoutService();
        //Act
        $result = $this->sut->logout();
        //Assert
        $this->assertTrue($result);
    }
}
