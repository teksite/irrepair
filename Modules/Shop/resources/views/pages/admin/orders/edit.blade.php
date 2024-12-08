<x-main::admin-editor-layout :instance="$order" method="PATCH" :publishStatus="false">
    @section('title',__('edit :title',['title'=>__('order')]))
    @section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('order'),'item'=>$order->order_number]))
    @section('formRoute',route('admin.sell.orders.update', $order))
    @section('hero-start-section')
        <x-main::link.header :href="route('admin.sell.orders.index')" :title="__('all :title',['title'=>__('orders')])"/>
    @endsection
    @section('top')

    @endsection
    @section('main')
        <div class="grid gap-6 lg:grid-cols-2">
            <div>
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
                                {{__($order->status)}}
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

            </div>
            <div>
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
                                    {{$order?->details->name ?? $order->user->name}}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('phone')}}
                                </th>
                                <td class="p-3">
                             <span dir="ltr">
                                    {{$order?->details->phone ?? $order->user->phone}}
                             </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('email')}}
                                </th>
                                <td class="p-3">
                                    {{$order?->details->email ?? $order->user->email}}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('address')}}
                                </th>
                                <td class="p-3">
                                    {{$order?->details->address?->map(fn ($value , $key)=> __($key) . ': ' . $value)->implode(', ')}}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('zip code')}}
                                </th>
                                <td class="p-3">
                                    {{$order?->details->zip_code ?? ''}}
                                </td>
                            </tr>

                            <tr>
                                <th class="p-3">
                                    {{__('status')}}
                                </th>
                                <td class="p-3">
                                    <x-main::input.select id="status" name="status" :value="old('status') ?? $order?->details->status" >
                                        @foreach(\Modules\Shop\Enums\OrderStatusEnum::cases() as $orderStatus)
                                            <option value="{{$orderStatus->value}}" {{$order?->details->status == $orderStatus->value ? 'selected' : ''}}>
                                                {{__($orderStatus->value)}}
                                            </option>
                                        @endforeach
                                    </x-main::input.select>
                                    <x-main::input.error :messages="$errors->get('status')" class="mt-2"/>
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('delivery')}}
                                </th>
                                <td class="p-3">
                                    <x-main::input.select id="delivery" name="delivery" :value="old('delivery') ?? $order?->details->delivery" >
                                        @foreach(\Modules\Shop\Enums\DeliveryEnum::cases() as $deliveryType)
                                            <option value="{{$deliveryType->value}}" {{$order?->details->delivery == $deliveryType->value ? 'selected' : ''}}>
                                                {{__($deliveryType->value)}}
                                            </option>
                                        @endforeach
                                    </x-main::input.select>
                                    <x-main::input.error :messages="$errors->get('delivery')" class="mt-2"/>
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('tracking post code')}}
                                </th>
                                <td class="p-3">
                                    <x-main::input.text id="tracking_post_code" name="tracking_post_code" :value="old('tracking_post_code') ?? $order?->details->tracking_post_code" />
                                    <x-main::input.error :messages="$errors->get('tracking_post_code')" class="mt-2"/>
                                </td>
                            </tr>
                        </x-main::table>
                    </x-main::box>
                @endif

            </div>
        </div>

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

