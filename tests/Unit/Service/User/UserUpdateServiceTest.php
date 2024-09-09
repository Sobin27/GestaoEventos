<?php
namespace Service\User;

use App\Core\Repository\User\IFindUserByUuidRepository;
use App\Core\Repository\User\IUserUpdateRepository;
use App\Core\Repository\User\IVerifyIfEmailExistsRepository;
use App\Core\Repository\User\IVerifyIfLoginExistsRepository;
use App\Core\Service\User\IUserUpdateService;
use App\Domain\Services\User\UserUpdateService;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class UserUpdateServiceTest extends TestCase
{
    use withFaker;
    private IUserUpdateService $sut;

    public function test_updateUser_withValidData_shouldPersist(): void
    {
        //Arrange
        $user = User::factory()->makeOne();
        $request = Mockery::mock(UserUpdateRequest::class);
        $request->uuid = (string)$user->uuid;
        $request->name = $this->faker->name;
        $request->email = $this->faker->email;
        $request->login = $this->faker->userName;
        $userVerifyIfEmailExistsRepository = Mockery::mock(IVerifyIfEmailExistsRepository::class);
        $userVerifyIfLoginExistsRepository = Mockery::mock(IVerifyIfLoginExistsRepository::class);
        $userFindByUuidRepository = Mockery::mock(IFindUserByUuidRepository::class);
        $userRepository = Mockery::mock(IUserUpdateRepository::class);
        $userFindByUuidRepository->shouldReceive('findUserByUuid')
            ->once()
            ->with($request->uuid)
            ->andReturn($user);
        $userVerifyIfEmailExistsRepository->shouldReceive('verifyIfEmailExists')
            ->once()
            ->with($request->email)
            ->andReturn(false);
        $userVerifyIfLoginExistsRepository->shouldReceive('checkIfLoginExists')
            ->once()
            ->with($request->login)
            ->andReturn(false);
        $userRepository->shouldReceive('updatedUser')
            ->once()
            ->with($user)
            ->andReturn(true);
        $this->sut = new UserUpdateService($userRepository,$userVerifyIfEmailExistsRepository,$userVerifyIfLoginExistsRepository,$userFindByUuidRepository);
        //Act
        $result = $this->sut->updatedUser($request);
        //Assert
        $this->assertTrue($result);
    }
    public function test_updateUser_withInvalidEmail_returnException(): void
    {
        //Arrange
        $user = User::factory()->makeOne();
        $request = Mockery::mock(UserUpdateRequest::class);
        $request->uuid = (string)$user->uuid;
        $request->name = $this->faker->name;
        $request->email = $this->faker->email;
        $request->login = $this->faker->userName;
        $userVerifyIfEmailExistsRepository = Mockery::mock(IVerifyIfEmailExistsRepository::class);
        $userVerifyIfLoginExistsRepository = Mockery::mock(IVerifyIfLoginExistsRepository::class);
        $userFindByUuidRepository = Mockery::mock(IFindUserByUuidRepository::class);
        $userRepository = Mockery::mock(IUserUpdateRepository::class);
        $userFindByUuidRepository->shouldReceive('findUserByUuid')
            ->once()
            ->with($request->uuid)
            ->andReturn($user);
        $userVerifyIfEmailExistsRepository->shouldReceive('verifyIfEmailExists')
            ->once()
            ->with($request->email)
            ->andReturn(true);
        $this->sut = new UserUpdateService($userRepository,$userVerifyIfEmailExistsRepository,$userVerifyIfLoginExistsRepository,$userFindByUuidRepository);
        //Assert
        $this->expectException(Exception::class);
        //Act
        $this->sut->updatedUser($request);
    }
    public function test_updateUser_withInvalidLogin_returnsException()
    {
        //Arrange
        $user = User::factory()->makeOne();
        $request = Mockery::mock(UserUpdateRequest::class);
        $request->uuid = (string)$user->uuid;
        $request->name = $this->faker->name;
        $request->email = $this->faker->email;
        $request->login = $this->faker->userName;
        $userVerifyIfEmailExistsRepository = Mockery::mock(IVerifyIfEmailExistsRepository::class);
        $userVerifyIfLoginExistsRepository = Mockery::mock(IVerifyIfLoginExistsRepository::class);
        $userFindByUuidRepository = Mockery::mock(IFindUserByUuidRepository::class);
        $userRepository = Mockery::mock(IUserUpdateRepository::class);
        $userFindByUuidRepository->shouldReceive('findUserByUuid')
            ->once()
            ->with($request->uuid)
            ->andReturn($user);
        $userVerifyIfEmailExistsRepository->shouldReceive('verifyIfEmailExists')
            ->once()
            ->with($request->email)
            ->andReturn(false);
        $userVerifyIfLoginExistsRepository->shouldReceive('checkIfLoginExists')
            ->once()
            ->with($request->login)
            ->andReturn(true);
        $this->sut = new UserUpdateService($userRepository,$userVerifyIfEmailExistsRepository,$userVerifyIfLoginExistsRepository,$userFindByUuidRepository);
        //Assert
        $this->expectException(Exception::class);
        //Act
        $this->sut->updatedUser($request);
    }
}
