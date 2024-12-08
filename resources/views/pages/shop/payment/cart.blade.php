<x-client-layout>
    <div id="page-content" class="about-page">
        <main class="">
            <section class="mb-12 content-center min-h-screen-1/2 py-24 inner-container">
                <h1 class="text-center">
                    {{__('cart')}}
                </h1>

                <div class="border border-slate-200 rounded-lg p-6">
                    <table class="border-collapse w-full border border-slate-200 bg-white text-sm shadow-sm">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="text-start p-3">{{__('products')}}</th>
                            <th class="text-center p-3">{{__('type')}}</th>
                            <th class="text-center p-3">{{__('quantity')}}</th>
                            <th class="text-center p-3">{{__('unit price')}}</th>
                            <th class="text-center p-3">{{__('total price')}}</th>
                            <th class="text-center p-3"></th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @foreach($cart->products as $product)
                            <tr class="hover:bg-gray-50" id="product-{{$loop->iteration}}">
                                <td class="text-start p-3">
                                    <a href="{{$product->path()}}">
                                        {{$product->title}}
                                    </a>
                                </td>
                                <td class="p-3">
                                    {{__($product->pivot->type)}}
                                </td>
                                <td class="p-3">
                                    {{$product->pivot->quantity}}
                                </td>
                                <td class="p-3">
                                    @php
                                        $totalPrice = $totalPrice ?? 0;
                                            $type=$product->pivot->type;
                                            $sell="price_".$type."_sell";
                                            $regular="price_".$type."_regular";
                                            $price=is_null($product->$sell) ? $product->$regular : $product->$sell;
                                            $sumPrices = $price * $product->pivot->quantity;
                                            $totalPrice =  $totalPrice + $sumPrices
                                    @endphp
                                    {{number_format($price)}}
                                </td>
                                <td class="p-3">
                                    {{number_format($sumPrices)}}
                                </td>

                                <td class="p-3">
                                    <form action="{{route('cart.destroy')}}" method="POST" class="deleteFromCart">
                                        @csrf @method('DELETE')
                                        <input type="text" class="hidden" readonly name="registerationId">
                                        <input type="hidden" class="hidden" readonly name="identification"
                                               value="{{encrypt($product->id)}}">
                                        <input type="hidden" class="hidden" readonly name="entity"
                                               value="{{encrypt(get_class($product))}}">
                                        <button  class="bg-red-600 p-1 rounded-lg removeFromCart" data-target="product-{{$loop->iteration}}">
                                            <i class="tkicon cross fill-none stroke-gray-200 stroke-2" size="14"
                                               data-icon="cross"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5" class="p-3 flex">
                                <span>{{__('total')}}</span>
                                {{number_format($totalPrice)}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="p-3">
                                <div class="flex justify-end">
                                    <form action="{{route('payment.order')}}" >
                                        @csrf
                                        <x-button.primary class="">
                                            {{__('checkout')}}
                                        </x-button.primary>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>


            </section>
        </main>
    </div>


</x-client-layout>
