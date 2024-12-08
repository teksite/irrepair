<?php

namespace Modules\Shop\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "name" => 'string|required',
            "email" => 'string|required|email',
            "phone" => 'string|required',
            "zip_code" => 'string|required',
            "address" => 'array|required',
            "address.street" => 'string|required',
            "address.city" => 'string|required',
            "address.province" => 'string|required',
            "geo" => 'array|required',
            "geo.latitude" => 'string|required',
            "geo.longitude" => 'string|required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasCart();
    }
}
