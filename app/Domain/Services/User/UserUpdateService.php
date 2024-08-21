<?php
namespace App\Domain\Services\User;

use App\Core\Infra\Database\Repository\User\IFindUserByUuidRepository;
use App\Core\Infra\Database\Repository\User\IUserUpdateRepository;
use App\Core\Infra\Database\Repository\User\IVerifyIfEmailExistsRepository;
use App\Core\Infra\Database\Repository\User\IVerifyIfLoginExistsRepository;
use App\Core\Service\User\IUserUpdateService;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Exception;

class UserUpdateService implements IUserUpdateService
{
    private UserUpdateRequest $request;
    private User $user;
    public function __construct(
        private readonly IUserUpdateRepository $userUpdateRepository,
        private readonly IVerifyIfEmailExistsRepository $verifyIfEmailExistsRepository,
        private readonly IVerifyIfLoginExistsRepository $verifyIfLoginExistsRepository,
        private readonly IFindUserByUuidRepository $findUserByUuidRepository
    )
    { }

    /**
     * @throws Exception
     */
    public function updatedUser(UserUpdateRequest $request): bool
    {
        $this->setRequest($request);
        $this->setUser();
        $this->checkIfEmailExists();
        $this->checkIfLoginExists();
        $this->mapperUser();
        return $this->updateUser();
    }

    private function setRequest(UserUpdateRequest $request): void
    {
        $this->request = $request;
    }
    private function setUser(): void
    {
        $this->user = $this->findUserByUuidRepository->findUserByUuid($this->request->uuid);
    }

    /**
     * @throws Exception
     */
    private function checkIfEmailExists(): void
    {
        if ($this->verifyIfEmailExistsRepository->verifyIfEmailExists($this->request->email)) {
            throw new Exception('Email already exists');
        }
    }
    /**
     * @throws Exception
     */
    private function checkIfLoginExists(): void
    {
        if ($this->verifyIfLoginExistsRepository->checkIfLoginExists($this->request->login)) {
            throw new Exception('Login already exists');
        }
    }
    private function updateUser(): bool
    {
        return $this->userUpdateRepository->updatedUser($this->user);
    }
    private function mapperUser(): void
    {
        $this->user->name = $this->request->name ?? $this->user->name;
        $this->user->email = $this->request->email ?? $this->user->email;
        $this->user->login = $this->request->login ?? $this->user->login;
    }
}
