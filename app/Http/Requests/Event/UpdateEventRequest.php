<?php
namespace App\Http\Requests\Event;

use App\Http\Requests\BaseRequest;

/**
 * @property int $eventId
 * @property string $name
 * @property string $description
 * @property string $type
 * @property string $organizingCompany
 * @property int $maxParticipants
 * @property string $durationTime
 * @property string $eventDate
 * @property string $address
 * @property string $city
 * @property string $country
 * @property string $state
 * @property bool $active
 */
class UpdateEventRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'eventId' => 'required|integer',
            'name' => 'string',
            'description' => 'string',
            'type' => 'string',
            'organizingCompany' => 'string',
            'maxParticipants' => 'integer',
            'durationTime' => 'string',
            'eventDate' => 'date',
            'address' => 'string',
            'city' => 'string',
            'country' => 'string',
            'state' => 'string',
            'active' => 'boolean',
        ];
    }
}
