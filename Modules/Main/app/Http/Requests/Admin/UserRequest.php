<?php

namespace Modules\Main\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
{
    const default=[
        "name" => 'required|string',
        "email" => 'required|email|unique:users,email',
        "phone" => 'required|string|unique:users,phone',
        "username" => 'nullable|string|unique:users,username',

        'featured_image' => 'nullable|string',
        'nickname' => 'nullable|string',
        'code_meli' => 'nullable|string',

        "password" => ['sometimes'],
        "max_user_creation" => 'integer|min:-1' ,

        'meta' => 'array|nullable',
        'meta.max_user_creation.value' => 'nullable|string',
        'meta.social.*.value' => 'nullable|string',
        'meta.social.*.status' => 'sometimes|in:off,on',

        'roles' => 'required|array',
        'roles.*' => 'required|exists:roles,id',

        'permissions' => 'sometimes|array',
        'permissions.*' => 'exists:permissions,id',
    ];

    public function rules(): array
    {
        if (request()->method() == 'POST') {
                return array_merge(
                    Arr::only(self::default,["name","email","phone","username",]),
                    ['password' => ['required', 'min:8', 'confirmed', Rules\Password::defaults()],]
            );

        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return Arr::except(
                array_merge(self::default,[
                    "email" => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore($this->user->id)],
                    "phone" => ['required', 'string', 'min:5', Rule::unique('users', 'phone')->ignore($this->user->id)],
                ]),'username');
        }
        return [
            'nodata' => 'required|string|min:3|max:100|regex:/^[a-z0-9]+$/i',
        ];
    }

    public function authorize(): bool
    {
        $minCurrentRole=auth()->user()->roles()->min('hierarchy');

        if (request()->method() == 'POST') {
            return auth()->check() && auth()->user()->can("user-create");
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return auth()->check() && auth()->user()->can("user-edit") && $minCurrentRole <= $this->user->roles()->min('hierarchy');
        }
        return false;
    }
}
