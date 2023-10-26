<?php
namespace App\Providers\DependencyInjection;

use App\Dominio\Services\Login\ILoginService;
use App\Dominio\Services\Login\LoginService;
use App\Infra\DataBase\Repository\Login\ILoginRepository;
use App\Infra\DataBase\Repository\Login\LoginRepository;

class LoginDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [ILoginService::class, LoginService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [ILoginRepository::class, LoginRepository::class]
        ];
    }
}
