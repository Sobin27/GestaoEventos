<?php
namespace Service\User;

use App\Core\Repository\User\IUserListingRepository;
use App\Core\Service\User\IUserListingService;
use App\Domain\Services\User\UserListingService;
use App\Http\Requests\User\ListingUserRequest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Mockery;
use Tests\TestCase;

class UserListingServiceTest extends TestCase
{
    use WithFaker;
    private IUserListingService $sut;

    public function test_getUsers_returnsOk(): void
    {
        // Arrange
        $list = Collection::times(rand(10,20))
            ->map(fn() => ['id' => rand(1, 100), 'name' => $this->faker->name, 'email' => $this->faker->email]);
        $request = Mockery::mock(ListingUserRequest::class);
        $userRepository = Mockery::mock(IUserListingRepository::class);
        $userRepository
            ->shouldReceive('listingUsers')
            ->once()
            ->andReturn($list);
        $this->sut = new UserListingService($userRepository);
        // Act
        $result = $this->sut->listingUsers($request);
        // Assert
        $this->assertEquals($list, $result);
    }
}
