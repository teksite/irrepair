<?php

namespace Modules\Form\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Main\Enums\PublishStatusEnum;

class FormsRequest extends FormRequest
{

    public function rules(): array
    {

        if (request()->method() == 'POST') {
            return $this->defaultRules();

        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {

            return array_merge( $this->defaultRules(),
                [
                    'title' => ['required', 'string', Rule::unique('forms', 'title')->ignore($this->form->id)],
                ]
            );
        }
        return [
            'nodata' => 'required|string|min:3|max:100|regex:/^[a-z0-9]+$/i',
        ];
    }


    public function authorize(): bool
    {
        if (request()->method() == 'POST') {
            return auth()->check() && auth()->user()->can("form-create");
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return auth()->check() && auth()->user()->can("form-edit");
        }
        return false;
    }

    public function defaultRules():array
    {
        return [
            'title' => 'required|string|unique:forms,title',
            'body' => 'nullable|string',
            'emails' => 'nullable|string',
            'urls' => 'nullable|string',
            'phones' => 'nullable|string',
            'telegram_id' => 'nullable|string',
            'template' => 'nullable|string',
            'rules' => 'nullable|array',
            'has_file' => 'sometimes|nullable|boolean',
            'recaptcha' => 'sometimes|nullable|boolean',
        ];
    }
}
