<?php
namespace App\Core\Repository\User;

interface IUserConfirmedEmailRepository
{
    public function confirmEmail(string $uuid): bool;
}
