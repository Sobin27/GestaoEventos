<?php
namespace Repository\User;

use App\Core\Repository\User\IUserListingRepository;
use App\Data\User\UserListingRepository;
use App\Http\Requests\User\ListingUserRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Mockery;
use Tests\TestCase;

class UserListingRepositoryTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    private IUserListingRepository $sut;

    public function test_getUsers_returnsOk(): void
    {
        //Arrange
        User::factory(10)->create();
        $request = new ListingUserRequest();
        $this->sut = new UserListingRepository();
        //Act
        $result = $this->sut->listingUsers($request);
        //Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(Collection::class, $result);
    }
    public function test_getUsers_withFilterName_returnOk(): void
    {
        //Arrange
        $user = User::factory(10)->create();
        $request = new ListingUserRequest();
        $request->name = $user->first()->name;
        $this->sut = new UserListingRepository();
        //Act
        $result = $this->sut->listingUsers($request);
        //Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(1, $result);
    }
    public function test_getUsers_withFilterEmail_returnOk(): void
    {
        //Arrange
        $user = User::factory(10)->create();
        $request = new ListingUserRequest();
        $request->email = $user->first()->email;
        $this->sut = new UserListingRepository();
        //Act
        $result = $this->sut->listingUsers($request);
        //Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(1, $result);
    }
}
