<?php
namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

/**
 * @property string $name
 * @property string $email
 */
class ListingUserRequest extends BaseRequest
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
