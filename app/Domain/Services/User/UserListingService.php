<?php
namespace App\Domain\Services\User;

use App\Core\Repository\User\IUserListingRepository;
use App\Core\Service\User\IUserListingService;
use App\Http\Requests\User\ListingUserRequest;
use Illuminate\Support\Collection;

class UserListingService implements IUserListingService
{
    public function __construct(
        private readonly IUserListingRepository $userListingRepository
    )
    { }
    public function listingUsers(ListingUserRequest $request): Collection
    {
        return $this->userListingRepository->listingUsers($request);
    }
}
