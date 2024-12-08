<?php

namespace Modules\Main\Http\Requests\Panel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use Modules\Main\Action\ApiRequest;

class UploadApiAvatarRequest extends ApiRequest
{

    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:jpeg,jpg,png|max:2048',
            'type' => 'required|string|in:image',
            'user' => ['required', 'string', function ($attribute, $value, $fail) {
                if (Auth::id() != Crypt::decrypt($value) ) {
                    $fail('The identifier does not match the current user');
                }
            }],
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }

}
