<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $event_id
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $created_at
 * @property string $updated_at
 */
class EventAddress extends Model
{
    use HasFactory;

    protected $table = 'events_address';
    protected $fillable = [
        'event_id',
        'address',
        'city',
        'state',
        'country',
        'created_at',
        'updated_at',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Events::class);
    }
}
