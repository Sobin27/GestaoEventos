<?php
namespace App\Domain\Services\User;

use App\Core\Infra\Database\Repository\User\IUserConfirmedEmailRepository;
use App\Core\Service\User\IUserConfirmEmailService;

class UserConfirmEmailService implements IUserConfirmEmailService
{
    public function __construct(
        public readonly IUserConfirmedEmailRepository $userConfirmedEmailRepository
    )
    { }

    public function confirmEmail(string $uuid): bool
    {
        return $this->userConfirmedEmailRepository->confirmEmail($uuid);
    }
}
