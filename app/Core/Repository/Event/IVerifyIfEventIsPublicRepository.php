<?php
namespace App\Core\Repository\Event;

interface IVerifyIfEventIsPublicRepository
{
    public function verifyIfEventIsPublic(int $eventId): bool;
}
