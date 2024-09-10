<?php
namespace Service\Authentication;

use App\Core\Repository\Login\ILoginRepository;
use App\Core\Repository\User\IVerifyIfCredentialsIsCorrectRepository;
use App\Core\Service\Login\ILoginService;
use App\Domain\Services\Login\LoginService;
use App\Http\Requests\Login\LoginRequest;
use App\Models\User;
use App\Models\UserPassword;
use Exception;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Tests\TestCase;

class LoginServiceTest extends TestCase
{
    use WithFaker;
    private ILoginService $sut;
    public function test_login_withValidData_returnsok(): void
    {
        //Arrange
        $password = $this->faker->password;
        $user = User::factory()->makeOne();
        $user->id = rand(1, 100);
        UserPassword::factory()->makeOne([
            'user_id' => $user->id,
            'password' => Hash::make($password)
        ]);
        $request = Mockery::mock(LoginRequest::class);
        $request->login = $user->login;
        $request->password = $password;
        $loginRepository = Mockery::mock(ILoginRepository::class);
        $userVerifyIfCredentialsIsCorrectRepository = Mockery::mock(IVerifyIfCredentialsIsCorrectRepository::class);
        $userVerifyIfCredentialsIsCorrectRepository->shouldReceive('verifyIfCredentialIsCorrect')
            ->once()
            ->with($request->login, $request->password)
            ->andReturn(true);
        $loginRepository->shouldReceive('login')
            ->once()
            ->with($request)
            ->andReturn([]);
        $this->sut = new LoginService($loginRepository, $userVerifyIfCredentialsIsCorrectRepository);
        // Act
        $result = $this->sut->login($request);
            // Assert
        $this->assertNotNull($result);
        $this->assertIsArray($result);
    }
    public function test_login_withInvalidData_returns400(): void
    {
        //Arrange
        $password = $this->faker->password;
        $user = User::factory()->makeOne();
        $user->id = rand(1, 100);
        $request = Mockery::mock(LoginRequest::class);
        $request->login = $user->login;
        $request->password = $password;
        $loginRepository = Mockery::mock(ILoginRepository::class);
        $userVerifyIfCredentialsIsCorrectRepository = Mockery::mock(IVerifyIfCredentialsIsCorrectRepository::class);
        $userVerifyIfCredentialsIsCorrectRepository->shouldReceive('verifyIfCredentialIsCorrect')
            ->once()
            ->with($request->login, $request->password)
            ->andReturn(false);
        $this->sut = new LoginService($loginRepository, $userVerifyIfCredentialsIsCorrectRepository);
        // Assert
        $this->expectException(Exception::class);
        // Act
        $this->sut->login($request);
    }
}
