<x-main::admin-editor-layout :instance="$order" method="PATCH" :publishStatus="false">
    @section('title',__('edit :title',['title'=>__('order')]))
    @section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('order'),'item'=>$order->order_number]))
    @section('formRoute',route('admin.sell.orders.setChange', $order))
    @section('hero-start-section')
        <x-main::link.header :href="route('admin.sell.orders.index')"
                             :title="__('all :title',['title'=>__('orders')])"/>
    @endsection
    @section('top')

    @endsection
    @section('main')
        <x-main::box class="mb-6">
            <h3>
                {{__('order')}}
            </h3>
            <hr class="my-3">
            <x-main::table>
                <tr>
                    <th class="p-3">
                        {{__('order')}}
                    </th>
                    <td class="p-3">
                        {{$order->order_number}}
                    </td>
                </tr>
                <tr>
                    <th class="p-3">
                        {{__('created at')}}
                    </th>
                    <td class="p-3">
                         <span dir="ltr">
                             {{$order->created_at}}
                         </span>
                    </td>
                </tr>
                <tr>
                    <th class="p-3">
                        {{__('total price')}}
                    </th>
                    <td class="p-3">
                        {{number_format($order->price)}}
                    </td>
                </tr>
                <tr>
                    <th class="p-3">
                        {{__('status')}}
                    </th>
                    <td class="p-3">
                        <x-main::input.select id="status" name="status" class="w-full block">
                            @foreach(\Modules\Shop\Enums\PaymentEnum::cases() as $payType)
                                <option
                                    value="{{$payType->value}}" {{$order->status == $payType->value ? 'selected' : ''}}>
                                    {{__($payType->value)}}
                                </option>
                            @endforeach
                        </x-main::input.select>
                        <x-main::input.error :messages="$errors->get('status')" class="mt-2"/>
                    </td>
                </tr>

            </x-main::table>
        </x-main::box>
        @if($order?->payments)

            <x-main::box class="mb-6">
                <h3>
                    {{__('payment')}}
                </h3>
                <hr class="my-3">
                <x-main::table>
                    <tr>
                        <th class="p-3">
                            {{__('tracking code')}}
                        </th>
                        <td class="p-3">
                            {{$order?->payments->tracking_code ?? '-'}}
                        </td>
                    </tr>
                    <tr>
                        <th class="p-3">
                            {{__('created at')}}
                        </th>
                        <td class="p-3">
                             <span dir="ltr">
                                 {{$order?->payments->created_at}}
                             </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="p-3">
                            {{__('total price')}}
                        </th>
                        <td class="p-3">
                            {{number_format($order?->payments->price)}}
                        </td>
                    </tr>
                    <tr>
                        <th class="p-3">
                            {{__('status')}}
                        </th>
                        <td class="p-3">
                            {{$order?->payments->status ? __('paid') :__('failed')}}
                        </td>
                    </tr>
                </x-main::table>
            </x-main::box>
        @endif
        @if(count($order?->products))
            <x-main::box>
                <h3>{{__('products')}}</h3>
                <hr class="my-3">
                <ul>
                    @foreach($order?->products ?? [] as $product)
                        <li class="flex items-center gap3">
                            <a href="{{$product->path()}}" class="font-bold text-sm min-w-fit w-fit">
                                {{$product->title}}
                            </a>
                            <hr class="border-dashed w-full">
                            <div class="flex items-center gap-3 w-fit min-w-fit">
                                <span>{{$product->pivot->type}}</span>
                                <span>X{{$product->pivot->quantity}}</span>
                                <span>{{number_format($product->pivot->price)}}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </x-main::box>
        @endif
        @if($order?->details)
            <x-main::box class="mb-6">
                <h3>
                    {{__('invoice')}}
                </h3>
                <hr class="my-3">
                <x-main::table>
                    <tr>
                        <th class="p-3">
                            {{__('name')}}
                        </th>
                        <td class="p-3">
                            <x-main::input.text class="block w-full" id="phone" name="details[name]"
                                                :value="old('details.name') ?? $order?->details->name"/>
                            <x-main::input.error :messages="$errors->get('details.name')" class="mt-2"/>
                        </td>
                    </tr>
                    <tr>
                        <th class="p-3">
                            {{__('phone')}}
                        </th>
                        <td class="p-3">
                             <span dir="ltr">
                                 <x-main::input.text class="block w-full" id="phone" name="details[phone]"
                                                     :value="old('details.phone') ?? $order?->details->phone"/>
                                 <x-main::input.error :messages="$errors->get('details.phone')" class="mt-2"/>
                             </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="p-3">
                            {{__('email')}}
                        </th>
                        <td class="p-3">
                            <x-main::input.text class="block w-full" id="tracking_post_code" name="details[email]"
                                                :value="old('details.email') ?? $order?->details->email"/>
                            <x-main::input.error :messages="$errors->get('details.email')" class="mt-2"/>
                        </td>
                    </tr>
                    <tr>
                        <th class="p-3">
                            {{__('address')}}
                        </th>
                        <td class="p-3">
                            @foreach($order?->details->address as $key=>$address)
                                <div>
                                    <x-main::input.label :value="__($key)"/>
                                    <x-main::input.text class="block w-full" id="tracking_post_code"
                                                        name="details[address][{{$key}}]"
                                                        :value="old('details.address.'.$key) ?? $address"/>
                                    <x-main::input.error :messages="$errors->get('details.address.'.$key)"
                                                         class="mt-2"/>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="p-3">
                            {{__('zip code')}}
                        </th>
                        <td class="p-3">
                            <x-main::input.text class="block w-full" id="tracking_post_code" name="details[zip_code]"
                                                :value="old('details.zip_code') ?? $order?->details->zip_code"/>
                            <x-main::input.error :messages="$errors->get('details.zip_code')" class="mt-2"/>
                        </td>
                    </tr>
                    <tr>
                        <th class="p-3">
                            {{__('status')}}
                        </th>
                        <td class="p-3">
                            <x-main::input.select id="status" name="details[status]" class="w-full block">
                                @foreach(\Modules\Shop\Enums\OrderStatusEnum::cases() as $orderStatus)
                                    <option
                                        value="{{$orderStatus->value}}" {{$order?->details->status == $orderStatus->value ? 'selected' : ''}}>
                                        {{__($orderStatus->value)}}
                                    </option>
                                @endforeach
                            </x-main::input.select>
                            <x-main::input.error :messages="$errors->get('details.status')" class="mt-2"/>
                        </td>
                    </tr>
                    <tr>
                        <th class="p-3">
                            {{__('delivery')}}
                        </th>
                        <td class="p-3">
                            <x-main::input.select id="delivery" name="details[delivery]" class="w-full block">
                                @foreach(\Modules\Shop\Enums\DeliveryEnum::cases() as $deliveryType)
                                    <option
                                        value="{{$deliveryType->value}}" {{$order?->details->delivery == $deliveryType->value ? 'selected' : ''}}>
                                        {{__($deliveryType->value)}}
                                    </option>
                                @endforeach
                            </x-main::input.select>
                            <x-main::input.error :messages="$errors->get('details.delivery')" class="mt-2"/>
                        </td>
                    </tr>
                    <tr>
                        <th class="p-3">
                            {{__('tracking post code')}}
                        </th>
                        <td class="p-3">
                            <x-main::input.text class="block w-full" id="tracking_post_code"
                                                name="details[tracking_post_code]"
                                                :value="old('details.tracking_post_code') ?? $order?->details->tracking_post_code"/>
                            <x-main::input.error :messages="$errors->get('details.tracking_post_code')" class="mt-2"/>
                        </td>
                    </tr>
                </x-main::table>
            </x-main::box>
        @endif

    @endsection
    @section('aside')
        <x-main::box>
            <x-main::input.label for="note" :value="__('note')"/>

            <x-main::input.textarea id="note" name="details[note]" class="block w-full"
                                    rows="6">{{old('details.note') ?? $order?->details->note }}</x-main::input.textarea>
            <x-main::input.error :messages="$errors->get('details.note')" class="mt-2 "/>
        </x-main::box>
    @endsection

</x-main::admin-editor-layout>

