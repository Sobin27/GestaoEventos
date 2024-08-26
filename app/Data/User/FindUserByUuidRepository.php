<?php
namespace App\Data\User;

use App\Core\Repository\User\IFindUserByUuidRepository;
use App\Models\User;

class FindUserByUuidRepository implements IFindUserByUuidRepository
{
    public function findUserByUuid(string $uuid): User
    {
        return User::query()
            ->where('uuid', $uuid)
            ->get()
            ->first();
    }
}
