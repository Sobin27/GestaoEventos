<?php
namespace Repository\User;

use App\Core\Repository\User\IFindUserByUuidRepository;
use App\Data\User\FindUserByUuidRepository;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserFindByUuidRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private IFindUserByUuidRepository $sut;

    public function test_getUserByUuid_returnsOk(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->sut = new FindUserByUuidRepository();
        //Act
        $result = $this->sut->findUserByUuid($user->uuid);
        //Assert
        $this->assertEquals($user->uuid, $result->uuid);
        $this->assertInstanceOf(User::class, $result);
    }
}
