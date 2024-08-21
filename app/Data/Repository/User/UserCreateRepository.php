<?php
namespace App\Data\Repository\User;

use App\Core\Infra\Database\Repository\User\IUserCreateRepository;
use App\Http\Requests\User\UserCreateRequest;
use App\Models\User;
use App\Models\UserPassword;
use Illuminate\Support\Facades\Hash;
use Str;

class UserCreateRepository implements IUserCreateRepository
{
    public function insertUser(UserCreateRequest $request): bool
    {
        $userCreated = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'login' => $request->login,
            'uuid' => Str::uuid(),
            'created_at' => now(),
            'created_by' => $request->name,
            'updated_by' => $request->name,
            'updated_at' => now()
        ]);

        return (bool)$this->createPasswordUser($userCreated, $request);
    }
    private function createPasswordUser(User|null $userCreated, UserCreateRequest $request)
    {
        return UserPassword::query()->create([
            'user_id' => $userCreated->id,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'created_by' => $userCreated->name,
        ]);
    }
}
