<?php
namespace App\Core\Traits;

use App\Models\Events;
use App\Events\CancelEvent as CancelEventEvent;
use Illuminate\Support\Facades\Log;

trait CancelEvent
{
    public function eventCancel(Events $events): void
    {
        CancelEventEvent::dispatch($events);
    }
}
