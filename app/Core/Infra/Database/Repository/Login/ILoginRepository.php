<?php
namespace App\Core\Infra\Database\Repository\Login;

use App\Http\Requests\Login\LoginRequest;

interface ILoginRepository
{
    public function login(LoginRequest $request): array;
}
