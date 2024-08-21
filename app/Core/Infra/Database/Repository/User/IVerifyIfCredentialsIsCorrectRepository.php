<?php

namespace App\Core\Infra\Database\Repository\User;

interface IVerifyIfCredentialsIsCorrectRepository
{
    public function verifyIfCredentialIsCorrect(string $login, string $password): bool;
}
