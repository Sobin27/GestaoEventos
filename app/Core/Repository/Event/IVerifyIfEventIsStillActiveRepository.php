<?php
namespace App\Core\Repository\Event;

interface IVerifyIfEventIsStillActiveRepository
{
    public function verifyIfEventIsStillActive(int $eventId): bool;
}
