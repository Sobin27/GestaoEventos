<?php
namespace Repository\User;

use App\Core\Repository\User\IVerifyIfCredentialsIsCorrectRepository;
use App\Data\User\VerifyIfCredentialsIsCorrectRepository;
use App\Models\User;
use App\Models\UserPassword;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class VerifyIfCredentialsIsCorrectRepositoryTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    private IVerifyIfCredentialsIsCorrectRepository $sut;

    public function test_verifyIfCredentialsIsCorrect_withValidData_returnsTrue(): void
    {
        //Arrange
        $password = $this->faker->password;
        $user = User::factory()->createOne();
        UserPassword::factory()->createOne([
            'user_id' => $user->id,
            'password' => Hash::make($password)
        ]);
        $this->sut = new VerifyIfCredentialsIsCorrectRepository();
        //Act
        $result = $this->sut->verifyIfCredentialIsCorrect($user->login, $password);
        //Assert
        $this->assertTrue($result);
    }
    public function test_verifyIfCredentialsIsCorrect_withInValidData_returnsFalse(): void
    {
        //Arrange
        $password = $this->faker->password;
        $user = User::factory()->createOne();
        UserPassword::factory()->createOne([
            'user_id' => $user->id,
            'password' => Hash::make(rand(1, 100))
        ]);
        $this->sut = new VerifyIfCredentialsIsCorrectRepository();
        //Act
        $result = $this->sut->verifyIfCredentialIsCorrect($user->login, $password);
        //Assert
        $this->assertFalse($result);
    }
}
