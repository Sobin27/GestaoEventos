<?php
namespace App\Core\Infra\Database\Repository\User;

use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;

interface IUserUpdateRepository
{
    public function updatedUser(User $user): bool;
}
