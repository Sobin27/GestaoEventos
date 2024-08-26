<?php

namespace App\Core\Repository\User;

interface IVerifyIfCredentialsIsCorrectRepository
{
    public function verifyIfCredentialIsCorrect(string $login, string $password): bool;
}
