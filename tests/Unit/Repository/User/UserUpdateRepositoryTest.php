<?php
namespace Repository\User;

use App\Core\Repository\User\IUserUpdateRepository;
use App\Data\User\UserUpdateRepository;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class UserUpdateRepositoryTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    private IUserUpdateRepository $sut;

    public function test_updateUser_withValidData_shouldPersist(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $request = Mockery::mock(UserUpdateRequest::class);
        $request->name = $this->faker->name;
        $request->email = $this->faker->email;
        $request->login = $this->faker->userName;
        $user->id = $this->faker->randomNumber();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->login = $request->login;
        $this->sut = new UserUpdateRepository();
        //Act
        $result = $this->sut->updatedUser($user);
        //Assert
        $this->assertTrue($result);
    }
}
