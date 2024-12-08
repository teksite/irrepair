<?php

namespace Modules\Shop\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Main\Enums\PublishStatusEnum;
use Modules\Shop\Enums\DeliveryEnum;
use Modules\Shop\Enums\OrderStatusEnum;

class OrderRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'tracking_post_code' => 'nullable|string',
            'status' => ['required', Rule::in(array_column(OrderStatusEnum::cases(), 'value'))],
            'delivery' => ['required', Rule::in(array_column(DeliveryEnum::cases(), 'value'))],
            'note' =>'nullable|string',
        ];
    }


    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('order-edit');
    }
}
