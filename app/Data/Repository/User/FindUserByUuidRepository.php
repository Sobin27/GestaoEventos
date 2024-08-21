<?php
namespace App\Data\Repository\User;

use App\Core\Infra\Database\Repository\User\IFindUserByUuidRepository;
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
