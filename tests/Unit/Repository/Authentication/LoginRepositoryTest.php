<?php
namespace Repository\Authentication;

use App\Core\Repository\Login\ILoginRepository;
use App\Data\Login\LoginRepository;
use App\Http\Requests\Login\LoginRequest;
use App\Models\User;
use App\Models\UserPassword;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Tests\TestCase;

class LoginRepositoryTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    private ILoginRepository $sut;

    public function test_login_withValidData_returnsOk(): void
    {
        //Arrange
        $password = $this->faker->password;
        $user = User::factory()->createOne();
        UserPassword::factory()->createOne([
            'user_id' => $user->id,
            'password' => Hash::make($password)
        ]);
        $request = Mockery::mock(LoginRequest::class);
        $request->login = $user->login;
        $request->password = $password;
        $this->sut = new LoginRepository();
        //Act
        $result = $this->sut->login($request);
        //Assert
        $this->assertNotNull($result);
        $this->assertIsArray($result);
    }
}
