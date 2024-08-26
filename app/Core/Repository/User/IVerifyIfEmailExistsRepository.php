<?php
namespace App\Core\Repository\User;

interface IVerifyIfEmailExistsRepository
{
    public function verifyIfEmailExists(string|null $email): bool;
}
