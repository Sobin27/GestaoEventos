<?php
namespace App\Core\Repository\User;

use App\Models\User;

interface IFindUserByUuidRepository
{
    public function findUserByUuid(string $uuid): User;
}
