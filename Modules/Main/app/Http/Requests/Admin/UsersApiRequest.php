<?php

namespace Modules\Main\Http\Requests\Admin;

use Modules\Main\Action\ApiRequest;

class UsersApiRequest extends ApiRequest
{

    public function rules(): array
    {
        return [
            'token' => 'required|string',
            "name" => 'required|string',
            "email" => 'required|email|unique:users,email',
            "phone" => 'required|string|unique:users,phone',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
