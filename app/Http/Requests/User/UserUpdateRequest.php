<?php
namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

/**
 * @property string $uuid
 * @property string $name
 * @property string $login
 * @property string $email
 */
class UserUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid' => 'required|string',
            'name' => 'string',
            'login' => 'string',
            'email' => 'email'
        ];
    }
}
