<?php
namespace App\Core\Service\User;

use App\Http\Requests\User\ListingUserRequest;
use Illuminate\Support\Collection;

interface IUserListingService
{
    public function listingUsers(ListingUserRequest $request): Collection;
}
