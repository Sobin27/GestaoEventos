<?php
namespace App\Core\Repository\User;

use App\Http\Requests\User\ListingUserRequest;
use Illuminate\Support\Collection;

interface IUserListingRepository
{
    public function listingUsers(ListingUserRequest $request): Collection;
}
