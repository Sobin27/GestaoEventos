<?php
namespace App\Data\Repository\User;

use App\Core\Infra\Database\Repository\User\IVerifyIfEmailExistsRepository;
use App\Models\User;

class VerifyIfEmailExistsRepository implements IVerifyIfEmailExistsRepository
{
    public function verifyIfEmailExists(string $email): bool
    {
        return User::query()->where('email', $email)->exists();
    }
}
