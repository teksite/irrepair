@props(['open'=>true])
@php
    $priceList=[
    'price online'=>[
           'price_online_regular'=> 'regular',
           'price_online_sell'=> 'sell',
    ],
    'price offline'=>[
           'price_offline_regular'=> 'regular',
           'price_offline_sell'=> 'sell',
    ],
    'instalment'=>[
           'price_instalment_regular'=> 'regular',
           'price_instalment_sell'=> 'sell',
    ]
]
@endphp
<x-main::accordion.single :title="__('prices')" :open="$open">
    @foreach($priceList as $key=>$values)
        <div>
            {{__($key)}}
            <div class="grid gap-6 md:grid-cols-2">
                @foreach($values as $col=>$title)
                    <div>
                        <x-main::input.label for="{{$col}}" :value="__($title)" name="{{$col}}"/>
                        <x-main::input.text id="{{$col}}" class="block w-full" name="{{$col}}" value="{{old($col) ?? isset($instance) && $instance->$col ? $instance->$col : ''}}"/>
                        <x-main::input.error :messages="$errors->get($col)" class="mt-2"/>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

</x-main::accordion.single>
