<?php
namespace App\Core\Infra\Database\Repository\User;

interface IVerifyIfLoginExistsRepository
{
    public function checkIfLoginExists(string|null $login): bool;
}
