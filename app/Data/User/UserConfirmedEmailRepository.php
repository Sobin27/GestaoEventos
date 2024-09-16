<?php
namespace App\Data\User;

use App\Core\Repository\User\IUserConfirmedEmailRepository;
use App\Models\User;

class UserConfirmedEmailRepository implements IUserConfirmedEmailRepository
{

    public function confirmEmail(string $uuid): bool
    {
        return User::query()
            ->where('uuid', $uuid)
            ->update([
                'confirmed_email' => true,
                'email_verified_at' => now(),
            ]);
    }
}
