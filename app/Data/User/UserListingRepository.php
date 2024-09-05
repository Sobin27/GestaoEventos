<?php
namespace App\Data\User;

use App\Core\Repository\User\IUserListingRepository;
use App\Http\Requests\User\ListingUserRequest;
use App\Models\User;
use Illuminate\Support\Collection;

class UserListingRepository implements IUserListingRepository
{
    public function listingUsers(ListingUserRequest $request): Collection
    {
         return User::query()->select([
                 'id',
                 'name',
                 'email',
             ])->where($this->getFilter($request))->get()->map(function ($user) {
                 return $user->mapTo();
             });
    }
    private function getFilter(ListingUserRequest $request): array
    {
        $filter = [];
        if (isset($request->name)) {
            $filter[] = ['name', 'like', '%' . $request->name . '%'];
        }
        if (isset($request->email)) {
            $filter[] = ['email', 'like', '%' . $request->email . '%'];
        }
        return $filter;
    }
}
