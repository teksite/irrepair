<?php

namespace Modules\Main\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRobotFileRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'content'=>'string'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() &&  auth()->user()->can('seo-edit');
    }
}
