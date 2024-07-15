<?php
namespace App\Core\Infra\Database\Repository\User;

interface IVerifyIfEmailExistsRepository
{
    public function verifyIfEmailExists(string $email): bool;
}
