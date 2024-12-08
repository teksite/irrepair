<?php

namespace Modules\Main\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Modules\Main\Action\ApiRequest;

class GetSeoTypeRequest extends ApiRequest
{

    public function rules(): array
    {

        return [
            'seoType' => ['string', Rule::in(array_keys(config('global.seoschematype.pageType')))],
            'instance' => ['nullable'],
            'id' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('admin');
    }
}
