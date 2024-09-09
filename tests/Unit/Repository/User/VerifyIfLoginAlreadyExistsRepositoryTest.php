<?php
namespace Repository\User;

use App\Core\Repository\User\IVerifyIfLoginExistsRepository;
use App\Data\User\VerifyIfEmailExistsRepository;
use App\Data\User\VerifyIfLoginExistsRepository;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerifyIfLoginAlreadyExistsRepositoryTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    private IVerifyIfLoginExistsRepository $sut;


    public function test_ifLoginAlreadyExists_returnsTrue(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->sut = new VerifyIfLoginExistsRepository();
        //Act
        $result = $this->sut->checkIfLoginExists($user->login);
        //Assert
        $this->assertTrue($result);
    }
    public function test_ifLoginNotExists_returnsFalse(): void
    {
        $this->sut = new VerifyIfLoginExistsRepository();
        //Act
        $result = $this->sut->checkIfLoginExists($this->faker->userName);
        //Assert
        $this->assertFalse($result);
    }
}
