<?php

namespace Modules\Widget\Http\Requests;

use  Modules\Main\Action\ApiRequest;

class WidgetApiRequest extends ApiRequest
{

    public function rules(): array
    {
        return [
            'attributes'=>'required|array',
            'attributes.label'=>'required|string',
            'innerContent'=>'nullable',
            'attributes.*'=>'nullable|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
