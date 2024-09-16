<?php
namespace Repository\User;

use App\Core\Repository\User\IVerifyIfEmailExistsRepository;
use App\Data\User\VerifyIfEmailExistsRepository;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerifyIfEmailAlreadyExistsRepositoryTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    private IVerifyIfEmailExistsRepository $sut;


    public function test_ifEmailAlreadyExists_returnsTrue(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->sut = new VerifyIfEmailExistsRepository();
        //Act
        $result = $this->sut->verifyIfEmailExists($user->email);
        //Assert
        $this->assertTrue($result);
    }
    public function test_ifEmailNotExists_returnsFalse(): void
    {
        $this->sut = new VerifyIfEmailExistsRepository();
        //Act
        $result = $this->sut->verifyIfEmailExists($this->faker->email);
        //Assert
        $this->assertFalse($result);
    }
}
