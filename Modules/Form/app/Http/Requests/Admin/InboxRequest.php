<?php

namespace Modules\Form\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InboxRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'note'=>'nullable|string',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can("form-receive-edit");
    }
}
