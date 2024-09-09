<?php
namespace App\Data\User;

use App\Core\Repository\User\IUserUpdateRepository;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserUpdateRepository implements IUserUpdateRepository
{
    public function updatedUser(User $user): bool
    {
        try {
            return $user->updateOrFail();
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return false;
        }
    }
}
