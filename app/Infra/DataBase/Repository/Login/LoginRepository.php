<?php
namespace App\Infra\DataBase\Repository\Login;

use App\Exceptions\UnauthorizedException;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class LoginRepository implements ILoginRepository
{
    /**
     * @throws UnauthorizedException
     */
    public function login(LoginRequest $request): array
    {
        $credentials = [
            'email' => $request->login,
            'password' => $request->password
        ];
        $token = auth('api')->attempt($credentials, true);
        if (!$token){
            throw new UnauthorizedException('Senha ou usuário inválidos.');
        }

        return [
            'token' => $token,
            'userUuid' => auth()->user()->uuid,
            'userName' => auth()->user()->name,
            'userId' => auth()->user()->id
        ];
    }
}
