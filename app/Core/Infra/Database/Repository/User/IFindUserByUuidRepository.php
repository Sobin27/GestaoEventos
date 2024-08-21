<?php
namespace App\Core\Infra\Database\Repository\User;

use App\Models\User;

interface IFindUserByUuidRepository
{
    public function findUserByUuid(string $uuid): User;
}
