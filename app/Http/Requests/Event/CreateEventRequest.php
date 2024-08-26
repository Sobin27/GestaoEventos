<?php
namespace App\Http\Requests\Event;

use App\Http\Requests\BaseRequest;

/**
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
 */
class CreateEventRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|string',
            'organizingCompany' => 'required|string',
            'maxParticipants' => 'required|integer',
            'durationTime' => 'required|string',
            'eventDate' => 'required|date',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
        ];
    }
}
