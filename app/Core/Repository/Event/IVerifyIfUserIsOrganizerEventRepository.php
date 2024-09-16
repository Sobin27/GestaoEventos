<?php
namespace App\Core\Repository\Event;

interface IVerifyIfUserIsOrganizerEventRepository
{
    public function verifyIfUserIsOrganizerEvent(int $userId, int $eventId): bool;
}
