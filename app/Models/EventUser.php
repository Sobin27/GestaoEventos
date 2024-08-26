<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $event_id
 * @property int $user_id
 */
class EventUser extends Model
{
    use HasFactory;

    protected $table = 'events_participants';
    protected $fillable = [
        'event_id',
        'participant_id',
    ];

}
