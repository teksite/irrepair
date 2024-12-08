<?php

namespace Modules\Shop\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Main\Enums\PublishStatusEnum;
use Modules\Shop\Enums\DeliveryEnum;
use Modules\Shop\Enums\OrderStatusEnum;
use Modules\Shop\Enums\PaymentEnum;

class OrderChangeRequest extends FormRequest
{

    public function rules(): array
    {

        $detailsOrderRule=[];
        if($this->order->details){
            $detailsOrderRule=[
                'details'=>'required|array',
                'details.name' => 'required|string',
                'details.phone' => 'required|string',
                'details.email' => 'required|string',
                'details.zip_code' => 'required|string',
                'details.address' => 'nullable|array',
                'details.address.province' => 'nullable|string',
                'details.address.city' => 'nullable|string',
                'details.address.street' => 'nullable|string',
                'details.tracking_post_code' => 'nullable|string',
                'details.status' => ['required', Rule::in(array_column(OrderStatusEnum::cases(), 'value'))],
                'details.delivery' => ['required', Rule::in(array_column(DeliveryEnum::cases(), 'value'))],
                'details.note' =>'required|string',
            ];
        }
        return array_merge(
            ['status' => ['required', Rule::in(array_column(PaymentEnum::cases(), 'value'))]],
            $detailsOrderRule
        );

    }


    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('order-edit');
    }
}
