<?php
namespace App\Domain\Services\Login;

use App\Core\Repository\Login\ILogoutRepository;
use App\Core\Service\Login\ILogoutService;

class LogoutService implements ILogoutService
{
    public function __construct(
        private readonly ILogoutRepository $logoutRepository,
    )
    { }

    public function logout(): bool
    {
        return $this->logoutRepository->logout();
    }
}
