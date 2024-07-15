<?php
namespace App\Domain\Services\User;

use App\Core\Infra\Database\Repository\User\IUserCreateRepository;
use App\Core\Infra\Database\Repository\User\IVerifyIfEmailExistsRepository;
use App\Core\Service\User\IUserCreateService;
use App\Http\Requests\User\UserCreateRequest;
use Exception;

class UserCreateService implements IUserCreateService
{
    private UserCreateRequest $request;
    public function __construct(
        private readonly IVerifyIfEmailExistsRepository $verifyIfEmailExistsRepository,
        private readonly IUserCreateRepository $userCreateRepository,
    )
    { }

    /**
     * @throws Exception
     */
    public function createUser(UserCreateRequest $request): bool
    {
        $this->setRequest($request);
        $this->checkIfEmailExists();
        return $this->insertUser();
    }
    private function setRequest(UserCreateRequest $request): void
    {
        $this->request = $request;
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
    private function insertUser(): bool
    {
        return $this->userCreateRepository->insertUser($this->request);
    }
}
