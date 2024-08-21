<?php
namespace App\Domain\Services\Login;

use App\Core\Service\Login\ILogoutService;

class LogoutService implements ILogoutService
{
    public function logout(): void
    {
        auth()->logout();
    }
}
