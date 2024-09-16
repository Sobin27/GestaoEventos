<?php
namespace App\Core\Service\User;

use App\Http\Requests\User\UserUpdateRequest;

interface IUserUpdateService
{
    public function updatedUser(UserUpdateRequest $request): bool;
}
