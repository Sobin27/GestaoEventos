<?php
namespace App\Core\Repository\Event;

interface IEventDetailsRepository
{
    public function getDetailsEvents(int $eventId): array;
}
