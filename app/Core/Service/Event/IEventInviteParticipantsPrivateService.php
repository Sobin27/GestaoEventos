<?php
namespace App\Core\Service\Event;

use App\Models\Events;

interface IEventInviteParticipantsPrivateService
{
    public function invitationToParticipateInThePrivateEvent(Events $events, array $usersInvite): void;
}
