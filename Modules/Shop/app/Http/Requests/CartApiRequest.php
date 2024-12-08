<?php

namespace Modules\Shop\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Shop\Models\Product;

class CartApiRequest extends FormRequest
{
    public function rules(): array
    {
        if (request()->method() == 'POST') {
            return array_merge($this->defaultRules(),
                [
                    'type' => 'required|string|in:online,offline,instalment',
                    'cart' => ['required', 'string', function ($attribute, $value, $fail) {
                        try {
                            if ($value !== 'default') {
                                $fail('invalid cart');
                            }
                        } catch (\Exception $e) {
                            $fail('The provided cart is invalid.');
                        }
                    }],
                ]
            );
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT' || request()->method() == 'DELETE') {
            return $this->defaultRules();
        }
        return [
            'nodata' => 'required|string|min:3|max:100|regex:/^[a-z0-9]+$/i',
        ];
    }


    public function defaultRules(): array
    {
        return [
            'registerationId' => 'prohibited',
            'identification' => ['required', 'string', function ($attribute, $value, $fail) {
                try {
                    $decryptedId = decrypt($value);
                    if (!Product::query()->where('id', $decryptedId)->exists()) {
                        $fail('The selected product does not exist.');
                    }
                } catch (\Exception $e) {
                    $fail('The provided ID is invalid.');
                }
            }],
            'entity' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }
}
