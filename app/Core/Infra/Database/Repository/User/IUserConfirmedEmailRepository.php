<?php
namespace App\Core\Infra\Database\Repository\User;

interface IUserConfirmedEmailRepository
{
    public function confirmEmail(string $uuid): bool;
}
