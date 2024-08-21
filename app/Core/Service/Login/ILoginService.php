<?php
namespace App\Core\Service\Login;

use App\Http\Requests\Login\LoginRequest;

interface ILoginService
{
    public function login(LoginRequest $request): array;
}
