<?php
namespace App\Core\Repository\Event;


interface IVerifyHowManyParticipantsEventRepository
{
    public function verifyHoManyParticipants(int $eventId): array;
}
