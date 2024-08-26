<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $name
 * @property string $description
 * @property string $type
 * @property int $event_organizer
 * @property string $organizing_company
 * @property bool $active
 * @property int $max_participants
 * @property string $duration_time
 * @property string $event_date
 * @property string $created_at
 * @property string $updated_at
 */
class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'event_organizer',
        'organizing_company',
        'active',
        'max_participants',
        'duration_time',
        'event_date',
        'created_at',
        'updated_at',
    ];

    public function address(): HasOne
    {
        return $this->hasOne(EventAddress::class, 'event_id');
    }
}
