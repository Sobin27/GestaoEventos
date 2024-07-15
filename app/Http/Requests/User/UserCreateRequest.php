<?php
namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

/**
 * @property string name
 * @property string login
 * @property string email
 * @property string password
 */
class UserCreateRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'login' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }
}
