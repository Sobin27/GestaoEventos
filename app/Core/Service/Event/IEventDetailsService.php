<?php
namespace App\Core\Service\Event;

interface IEventDetailsService
{
    public function getDetailsEvents(int $eventId): array;
}
