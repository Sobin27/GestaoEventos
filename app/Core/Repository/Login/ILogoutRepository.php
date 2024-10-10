<?php
namespace App\Core\Repository\Login;

interface ILogoutRepository
{
    public function logout(): bool;
}
