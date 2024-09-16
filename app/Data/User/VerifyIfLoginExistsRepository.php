<?php
namespace App\Data\User;

use App\Core\Repository\User\IVerifyIfLoginExistsRepository;
use App\Models\User;

class VerifyIfLoginExistsRepository implements IVerifyIfLoginExistsRepository
{
    public function checkIfLoginExists(string|null $login): bool
    {
        return User::query()->where('login', $login)->exists();
    }
}
