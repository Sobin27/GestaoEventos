<?php
namespace App\Core\Service\User;

interface IUserConfirmEmailService
{
    public function confirmEmail(string $uuid): bool;
}
