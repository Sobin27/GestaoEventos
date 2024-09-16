<?php
namespace App\Core\Repository\User;

interface IVerifyIfLoginExistsRepository
{
    public function checkIfLoginExists(string|null $login): bool;
}
