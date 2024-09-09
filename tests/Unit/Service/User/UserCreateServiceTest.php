<?php
namespace Service\User;

use App\Core\Repository\User\IUserCreateRepository;
use App\Core\Repository\User\IVerifyIfEmailExistsRepository;
use App\Core\Repository\User\IVerifyIfLoginExistsRepository;
use App\Core\Service\User\IUserCreateService;
use App\Domain\Services\User\UserCreateService;
use App\Http\Requests\User\UserCreateRequest;
use Exception;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class UserCreateServiceTest extends TestCase
{
    use WithFaker;
    private IUserCreateService $sut;

    public function test_createUser_withValidData_shouldPersist(): void
    {
        //Arrange
        $request = Mockery::mock(UserCreateRequest::class);
        $request->name = $this->faker->name;
        $request->email = $this->faker->email;
        $request->login = $this->faker->userName;
        $request->password = $this->faker->password;
        $userVerifyIfEmailExistsRepository = Mockery::mock(IVerifyIfEmailExistsRepository::class);
        $userVerifyIfLoginExistsRepository = Mockery::mock(IVerifyIfLoginExistsRepository::class);
        $userRepository = Mockery::mock(IUserCreateRepository::class);
        $userVerifyIfEmailExistsRepository->shouldReceive('verifyIfEmailExists')
            ->once()
            ->with($request->email)
            ->andReturn(false);
        $userVerifyIfLoginExistsRepository->shouldReceive('checkIfLoginExists')
            ->once()
            ->with($request->login)
            ->andReturn(false);
        $userRepository->shouldReceive('insertUser')
            ->once()
            ->with($request)
            ->andReturn(true);
        $this->sut = new UserCreateService($userVerifyIfEmailExistsRepository,$userRepository,$userVerifyIfLoginExistsRepository,);
        //Act
        $result = $this->sut->createUser($request);
        //Assert
        $this->assertTrue($result);
    }
    public function test_createUser_withInvalidEmail_returnException(): void
    {
        //Arrange
        $request = Mockery::mock(UserCreateRequest::class);
        $request->name = $this->faker->name;
        $request->email = $this->faker->email;
        $request->login = $this->faker->userName;
        $request->password = $this->faker->password;
        $userVerifyIfEmailExistsRepository = Mockery::mock(IVerifyIfEmailExistsRepository::class);
        $userVerifyIfLoginExistsRepository = Mockery::mock(IVerifyIfLoginExistsRepository::class);
        $userRepository = Mockery::mock(IUserCreateRepository::class);
        $userVerifyIfEmailExistsRepository->shouldReceive('verifyIfEmailExists')
            ->once()
            ->with($request->email)
            ->andReturn(true);
        $this->sut = new UserCreateService($userVerifyIfEmailExistsRepository,$userRepository,$userVerifyIfLoginExistsRepository,);
        //Assert
        $this->expectException(Exception::class);
        //Act
        $this->sut->createUser($request);
    }
    public function test_createUser_withInvalidLogin_returnException(): void
    {
        //Arrange
        $request = Mockery::mock(UserCreateRequest::class);
        $request->name = $this->faker->name;
        $request->email = $this->faker->email;
        $request->login = $this->faker->userName;
        $request->password = $this->faker->password;
        $userVerifyIfEmailExistsRepository = Mockery::mock(IVerifyIfEmailExistsRepository::class);
        $userVerifyIfLoginExistsRepository = Mockery::mock(IVerifyIfLoginExistsRepository::class);
        $userRepository = Mockery::mock(IUserCreateRepository::class);
        $userVerifyIfEmailExistsRepository->shouldReceive('verifyIfEmailExists')
            ->once()
            ->with($request->email)
            ->andReturn(false);
        $userVerifyIfLoginExistsRepository->shouldReceive('checkIfLoginExists')
            ->once()
            ->with($request->login)
            ->andReturn(true);
        $this->sut = new UserCreateService($userVerifyIfEmailExistsRepository,$userRepository,$userVerifyIfLoginExistsRepository,);
        //Assert
        $this->expectException(Exception::class);
        //Act
        $this->sut->createUser($request);
    }
}
