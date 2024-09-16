<?php
namespace App\Http\Requests\Login;

use App\Http\Requests\BaseRequest;

/**
 * @property string login
 * @property string password
 */
class LoginRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
