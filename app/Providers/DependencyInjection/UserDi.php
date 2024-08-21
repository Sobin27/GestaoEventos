<?php
namespace App\Providers\DependencyInjection;

use App\Core\Infra\Database\Repository\User\IFindUserByUuidRepository;
use App\Core\Infra\Database\Repository\User\IUserConfirmedEmailRepository;
use App\Core\Infra\Database\Repository\User\IUserCreateRepository;
use App\Core\Infra\Database\Repository\User\IUserUpdateRepository;
use App\Core\Infra\Database\Repository\User\IVerifyIfCredentialsIsCorrectRepository;
use App\Core\Infra\Database\Repository\User\IVerifyIfEmailExistsRepository;
use App\Core\Infra\Database\Repository\User\IVerifyIfLoginExistsRepository;
use App\Core\Service\User\IUserConfirmEmailService;
use App\Core\Service\User\IUserCreateService;
use App\Core\Service\User\IUserUpdateService;
use App\Data\Repository\User\FindUserByUuidRepository;
use App\Data\Repository\User\UserConfirmedEmailRepository;
use App\Data\Repository\User\UserCreateRepository;
use App\Data\Repository\User\UserUpdateRepository;
use App\Data\Repository\User\VerifyIfCredentialsIsCorrectRepository;
use App\Data\Repository\User\VerifyIfEmailExistsRepository;
use App\Data\Repository\User\VerifyIfLoginExistsRepository;
use App\Domain\Services\User\UserConfirmEmailService;
use App\Domain\Services\User\UserCreateService;
use App\Domain\Services\User\UserUpdateService;

class UserDi extends DependencyInjection
{

    protected function services(): array
    {
        return [
            [IUserCreateService::class, UserCreateService::class],
            [IUserConfirmEmailService::class, UserConfirmEmailService::class],
            [IUserUpdateService::class, UserUpdateService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [IVerifyIfEmailExistsRepository::class, VerifyIfEmailExistsRepository::class],
            [IUserCreateRepository::class, UserCreateRepository::class],
            [IUserConfirmedEmailRepository::class, UserConfirmedEmailRepository::class],
            [IVerifyIfLoginExistsRepository::class, VerifyIfLoginExistsRepository::class],
            [IUserUpdateRepository::class, UserUpdateRepository::class],
            [IFindUserByUuidRepository::class, FindUserByUuidRepository::class],
            [IVerifyIfCredentialsIsCorrectRepository::class, VerifyIfCredentialsIsCorrectRepository::class]
        ];
    }
}
