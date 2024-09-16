<?php
namespace App\Data\User;

use App\Core\Repository\User\IVerifyIfCredentialsIsCorrectRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VerifyIfCredentialsIsCorrectRepository implements IVerifyIfCredentialsIsCorrectRepository
{
    public function verifyIfCredentialIsCorrect(string $login, string $password): bool
    {
        $user = User::query()->where('login', $login)->get()->first();
        if ($user and Hash::check($password, $user->userPassword->password)) {
            return true;
        }
        return false;
    }
}
