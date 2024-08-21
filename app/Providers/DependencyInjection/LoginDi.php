<?php
namespace App\Providers\DependencyInjection;

use App\Core\Infra\Database\Repository\Login\ILoginRepository;
use App\Core\Service\Login\ILoginService;
use App\Core\Service\Login\ILogoutService;
use App\Data\Repository\Login\LoginRepository;
use App\Domain\Services\Login\LoginService;
use App\Domain\Services\Login\LogoutService;

class LoginDi extends DependencyInjection
{

    protected function services(): array
    {
        return [
            [ILoginService::class, LoginService::class],
            [ILogoutService::class, LogoutService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [ILoginRepository::class, LoginRepository::class],
        ];
    }
}
