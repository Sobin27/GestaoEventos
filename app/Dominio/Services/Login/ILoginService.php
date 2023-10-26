<?php
namespace App\Dominio\Services\Login;

use App\Http\Requests\LoginRequest;

interface ILoginService
{
    public function login(LoginRequest $request): array;
    public function logout(): bool;
}
