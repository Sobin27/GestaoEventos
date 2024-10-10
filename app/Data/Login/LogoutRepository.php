<?php
namespace App\Data\Login;

use App\Core\Repository\Login\ILogoutRepository;

class LogoutRepository implements ILogoutRepository
{
    public function logout(): bool
    {
        if (auth()->check()) auth()->logout();
        return auth()->check() ? false : true;
    }
}
