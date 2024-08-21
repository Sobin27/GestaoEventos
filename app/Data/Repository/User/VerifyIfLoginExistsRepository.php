<?php
namespace App\Data\Repository\User;

use App\Core\Infra\Database\Repository\User\IVerifyIfLoginExistsRepository;
use App\Models\User;

class VerifyIfLoginExistsRepository implements IVerifyIfLoginExistsRepository
{

    public function checkIfLoginExists(string|null $login): bool
    {
        return User::query()->where('login', $login)->exists();
    }
}
