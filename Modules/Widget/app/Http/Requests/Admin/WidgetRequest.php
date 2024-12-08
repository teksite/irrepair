<?php

namespace Modules\Widget\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WidgetRequest extends FormRequest
{
    const default = [
        'title' => 'required|string|min:3|max:100',
        'body' => 'nullable|string'
    ];

    public function rules(): array
    {
        if (request()->method() == 'POST') {
            return self::default;

        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return self::default;
        }
        return [
            'nodata' => 'required|string|min:3|max:100|regex:/^[a-z0-9]+$/i',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (request()->method() == 'POST') {
            return auth()->check() && auth()->user()->can("widget-create");
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return auth()->check() && auth()->user()->can("widget-edit");
        }
        return false;
    }
}
