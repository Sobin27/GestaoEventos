<?php
namespace App\Core\Service\User;

use App\Http\Requests\User\UserCreateRequest;

interface IUserCreateService
{
    public function createUser(UserCreateRequest $request): bool;
}
