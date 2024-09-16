<?php
namespace App\Http\Requests\Event;

use App\Http\Requests\BaseRequest;

/**
 * @property string $type
 * @property boolean $active
 * @property string $name
 */
class MyEventsRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
        ];
    }
}
