<?php
namespace App\Domain\Services\Login;

use App\Core\Infra\Database\Repository\Login\ILoginRepository;
use App\Core\Infra\Database\Repository\User\IVerifyIfCredentialsIsCorrectRepository;
use App\Core\Service\Login\ILoginService;
use App\Http\Requests\Login\LoginRequest;
use Exception;

class LoginService implements ILoginService
{
    private LoginRequest $request;
    public function __construct(
        private readonly ILoginRepository $loginRepository,
        private readonly IVerifyIfCredentialsIsCorrectRepository $verifyIfCredentialsIsCorrectRepository,
    )
    { }

    /**
     * @throws Exception
     */
    public function login(LoginRequest $request): array
    {
        $this->setRequest($request);
        $this->checkIfLoginAndPasswordAreCorrect();
        return $this->userLogin();
    }
    private function setRequest(LoginRequest $request): void
    {
        $this->request = $request;
    }

    /**
     * @throws Exception
     */
    private function checkIfLoginAndPasswordAreCorrect(): void
    {
        if (!$this->verifyIfCredentialsIsCorrectRepository->verifyIfCredentialIsCorrect($this->request->login, $this->request->password)) {
            throw new Exception('Login or password is incorrect', 401);
        }
    }
    private function userLogin(): array
    {
        return $this->loginRepository->login($this->request);
    }
}
