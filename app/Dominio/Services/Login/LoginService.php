<?php
namespace App\Dominio\Services\Login;

use App\Exceptions\HttpBadRequestException;
use App\Http\Requests\LoginRequest;
use App\Infra\DataBase\Repository\Login\ILoginRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class LoginService implements ILoginService
{
    public function __construct(
        private readonly ILoginRepository $loginRepository
    )
    { }
    public function login(LoginRequest $request): array
    {
        return $this->loginRepository->login($request);
    }

    public function logout(): bool
    {
        try {
            auth()->logout();
            return true;
        }catch (Exception $e){
            Log::info($e->getMessage());
            throw new HttpBadRequestException('Erro ao efetuar logout');
        }
    }
}
