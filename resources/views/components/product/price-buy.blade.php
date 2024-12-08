@props(['product'])
@if($product->price_offline_regular || $product->price_online_regular)
    @if($product->price_offline_regular)
        <div class="border rounded-lg border-slate-200 border-dashed p-6 mb-6 flex flex-col sm:flex-row lg:flex-col xl:flex-row gap-3">
            <span class="h4 text-gray-600">
                قیمت دوره حضوری
            </span>
            @if($product->price_offline_sell)
                <div class="flex gap-6">
                    <del class="text-gray-400 front-bold text-xl">
                        {{number_format($product->price_offline_regular)}}
                    </del>
                    <span class="text-gray-900 front-bold text-lg font-bold">
                        {{number_format($product->price_offline_sell)}}
                    </span>
                </div>
            @else
                <span>
                     {{number_format($product->price_offline_regular)}}
                </span>
            @endif
            <span class="text-xl font-bold text-gray-400">تومان</span>
        </div>
    @endif
    @if($product->price_online_regular)
        <div class="border rounded-lg border-slate-200 border-dashed p-6 mb-6  flex flex-col sm:flex-row lg:flex-col xl:flex-row gap-3">
            <span class="h4 text-gray-600">
                قیمت دوره مجازی
            </span>
            @if($product->price_online_sell)
                <div class="flex gap-6">
                    <del class="text-gray-400 front-bold text-xl">
                        {{number_format($product->price_online_regular)}}
                    </del>
                    <span class="text-gray-900 front-bold text-lg font-bold">
                        {{number_format($product->price_online_sell)}}
                    </span>
                </div>
            @else
                <span class="text-gray-900 front-bold text-lg font-bold">
                    {{number_format($product->price_online_regular)}}
                </span>
            @endif
            <span class="text-xl font-bold text-gray-400">تومان</span>
        </div>
    @endif
    <div>
        @auth()
            <form action="{{route('cart.store')}}" method="POST" class="form addToCart">
                @csrf
                <fieldset class="border border-slate-200 rounded-lg p-6">
                    <legend>خرید این دوره</legend>
                    @csrf
                    <input type="text" class="hidden" name="registerationId">
                    <input type="hidden" class="hidden" readonly name="identification" value="{{encrypt($product->id)}}">
                    <input type="hidden" class="hidden" readonly name="entity" value="{{encrypt(get_class($product))}}">
                    <input type="text" class="hidden" name="cart" value="default">
                    @if($product->price_online_regular)
                        <div class="flex items-center">
                            <x-input.radio id="online_type" value="online" name="type"/>
                            <x-input.label for="online_type" value="حضوری" class="!mb-0 !text-lg"/>
                        </div>
                    @endif
                    @if($product->price_offline_regular)
                        <div class="flex items-center">
                            <x-input.radio id="offline_type" value="offline" name="type"/>
                            <x-input.label for="offline_type" value="مجازی" class="!mb-0 !text-lg"/>
                        </div>
                    @endif
                    @if($product->price_instalment_regular)
                        <div class="flex items-center">
                            <x-input.radio id="instalment_type" value="instalment" name="type"/>
                            <x-input.label for="instalment_type"
                                           value="اقساط (پیش پرداخت={{number_format($product->price_instalment_regular)}} تومان)"
                                           class="!mb-0 !text-lg"/>
                        </div>
                    @endif
                   @if(!auth()->user()->isInCart($product))
                        <div class="mt-6">
                            <x-button.primary class="flex items-center justify-center gap-3 w-full addToCart">
                                <i class="fill-none stroke-current tkicon" data-icon="bag"></i>
                                {{__('add to cart')}}
                            </x-button.primary>
                        </div>
                    @else
                        <p class="btn-solid-primary flex items-center justify-center gap-3">
                          این مورد در سبد خرید شما موجود است
                        </p>
                   @endif
                </fieldset>
            </form>
        @else
            <fieldset class="border border-slate-200 rounded-lg p-6">
                <legend>خرید این دوره</legend>

                @if($product->price_online_regular)

                    <div class="flex items-center">
                        <x-input.radio id="online_type" value="online" name="type"/>
                        <x-input.label for="online_type" value="حضوری" class="!mb-0 !text-lg"/>
                    </div>
                @endif
                @if($product->price_offline_regular)
                    <div class="flex items-center">
                        <x-input.radio id="offline_type" value="offline" name="type"/>
                        <x-input.label for="offline_type" value="مجازی" class="!mb-0 !text-lg"/>
                    </div>
                @endif
                @if($product->price_instalment_regular)
                    <div class="flex items-center">
                        <x-input.radio id="instalment_type" value="instalment" name="type"/>
                        <x-input.label for="instalment_type"
                                       value="اقساط (پیش پرداخت={{number_format($product->price_instalment_regular)}} تومان)"
                                       class="!mb-0 !text-lg"/>
                    </div>
                @endif
                <div class="mt-6">
                    جهت خرید این دوره باید وارد حساب کاربری خود شوید.
                    <a class="btn-solid-primary flex items-center justify-center gap-3" href="{{route('login')}}">
                        ورود/ساخت حساب کاربری
                        <i class="tkicon fill-none stroke-current" data-icon="login"></i>
                    </a>
                </div>
            </fieldset>
        @endauth
    </div>
@endif
