<?php

namespace Modules\Main\Action;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;


class ApiRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        return throw new HttpResponseException(response()->json([
            'messages' => $validator->errors(),
            'status' => 422,
            'data' => [],
            'result' => serverResponseMessage(422),
        ])->setStatusCode(422));
    }


    public function failedAuthorization()
    {
        return throw new HttpResponseException(response()->json([
            'messages' => ["Forbidden You don't have permission"],
            'status' => 403,
            'data' => [],
            'result' => serverResponseMessage(403),
        ])->setStatusCode(403));
    }
}
