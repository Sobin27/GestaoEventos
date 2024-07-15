<?php
namespace App\Core\Infra\Database\Repository\User;

use App\Http\Requests\User\UserCreateRequest;

interface IUserCreateRepository
{
    public function insertUser(UserCreateRequest $request): bool;
}
