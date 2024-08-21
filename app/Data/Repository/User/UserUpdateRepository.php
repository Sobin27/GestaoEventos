<?php
namespace App\Data\Repository\User;

use App\Core\Infra\Database\Repository\User\IUserUpdateRepository;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;

class UserUpdateRepository implements IUserUpdateRepository
{
    public function updatedUser(User $user): bool
    {
        return $user->update();
    }
}
