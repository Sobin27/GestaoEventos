<?php
namespace App\Infra\DataBase\Repository\Login;

use App\Http\Requests\LoginRequest;
use App\Models\User;

interface ILoginRepository
{
    public function login(LoginRequest $request): array;
}
