<?php
namespace App\Providers\DependencyInjection;

use App\Core\Repository\User\IFindUserByUuidRepository;
use App\Core\Repository\User\IUserConfirmedEmailRepository;
use App\Core\Repository\User\IUserCreateRepository;
use App\Core\Repository\User\IUserUpdateRepository;
use App\Core\Repository\User\IVerifyIfCredentialsIsCorrectRepository;
use App\Core\Repository\User\IVerifyIfEmailExistsRepository;
use App\Core\Repository\User\IVerifyIfLoginExistsRepository;
use App\Core\Service\User\IUserConfirmEmailService;
use App\Core\Service\User\IUserCreateService;
use App\Core\Service\User\IUserUpdateService;
use App\Data\User\FindUserByUuidRepository;
use App\Data\User\UserConfirmedEmailRepository;
use App\Data\User\UserCreateRepository;
use App\Data\User\UserUpdateRepository;
use App\Data\User\VerifyIfCredentialsIsCorrectRepository;
use App\Data\User\VerifyIfEmailExistsRepository;
use App\Data\User\VerifyIfLoginExistsRepository;
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
