<?php
namespace App\Providers\DependencyInjection;

use App\Core\Infra\Database\Repository\User\IUserConfirmedEmailRepository;
use App\Core\Infra\Database\Repository\User\IUserCreateRepository;
use App\Core\Infra\Database\Repository\User\IVerifyIfEmailExistsRepository;
use App\Core\Service\User\IUserConfirmEmailService;
use App\Core\Service\User\IUserCreateService;
use App\Data\Repository\User\UserConfirmedEmailRepository;
use App\Data\Repository\User\UserCreateRepository;
use App\Data\Repository\User\VerifyIfEmailExistsRepository;
use App\Domain\Services\User\UserConfirmEmailService;
use App\Domain\Services\User\UserCreateService;

class UserDi extends DependencyInjection
{

    protected function services(): array
    {
        return [
            [IUserCreateService::class, UserCreateService::class],
            [IUserConfirmEmailService::class, UserConfirmEmailService::class],
        ];
    }

    protected function repositories(): array
    {
        return [
            [IVerifyIfEmailExistsRepository::class, VerifyIfEmailExistsRepository::class],
            [IUserCreateRepository::class, UserCreateRepository::class],
            [IUserConfirmedEmailRepository::class, UserConfirmedEmailRepository::class]
        ];
    }
}
