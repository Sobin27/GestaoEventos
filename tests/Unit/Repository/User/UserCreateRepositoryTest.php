<?php
namespace Repository\User;

use App\Core\Repository\User\IUserCreateRepository;
use App\Data\User\UserCreateRepository;
use App\Http\Requests\User\UserCreateRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class UserCreateRepositoryTest extends TestCase
{
    use DatabaseTransactions, WithFaker;
    private IUserCreateRepository $sut;

    public function test_insertUser_withValidData_shouldPersist(): void
    {
        //Arrange
        $request = Mockery::mock(UserCreateRequest::class);
        $request->name = $this->faker->name;
        $request->email = $this->faker->email;
        $request->login = $this->faker->userName;
        $request->password = $this->faker->password;
        $this->sut = new UserCreateRepository();
        //Act
        $result = $this->sut->insertUser($request);
        //Assert
        $this->assertTrue($result);
    }
}
