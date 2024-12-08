<?php

namespace Modules\Shop\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValueRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'value' => 'required|string',
        ];
    }


        public function authorize(): bool
        {
            if (request()->method() == 'POST') {
                return auth()->check() && auth()->user()->can("product-create");
            } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
                return auth()->check() && auth()->user()->can("product-edit");
            }
            return false;
        }
}
