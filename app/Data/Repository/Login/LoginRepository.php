<?php
namespace App\Data\Repository\Login;

use App\Core\Infra\Database\Repository\Login\ILoginRepository;
use App\Http\Requests\Login\LoginRequest;
use App\Models\User;

class LoginRepository implements ILoginRepository
{
    public function login(LoginRequest $request): array
    {
        $user = User::query()->where('login', $request->login)->get()->first();
        $token = auth()->login($user);
        return [
            'Name' => $user->name,
            'Email' => $user->email,
            'Token' => $token,
        ];
    }
}
