@props(['open'=>'true','title'=>null ,'accordion'=>true])

@php
    $randomSec =\Illuminate\Support\Str::random(6).rand(999, 1000);
@endphp
@if($accordion)
    <div x-data="{open: {{$open}} }" class="transition duration-150 ease-in-out xbox !p-2">
        <button @click="open=!open" x-bind:title="open ? '{{__('close')}}' : '{{__('open')}}'" type="button"
                role="button" class="ps-3 py-1 pe-1 w-full flex items-center gap-1">
            <x-main::input.label for="acc-title-{{$randomSec}}" value="{{__($title)}}"/>
            <i :class="{'!-rotate-90':open , '!-rotate-0':!open}" class="tkicon ease-in-out transition-all me-0 ms-auto icon-accordion fill-none stroke-slate-400" size="9" data-icon="angle-left"></i>
        </button>
        <div x-show="open" x-cloak class="px-1" x-transition>
            {!! $slot ?? '' !!}
        </div>
    </div>
@else
    <x-main::input.label for="acc-title-{{$randomSec}}" value="{{__($title)}}"/>
   <div>
       {!! $slot ?? '' !!}
   </div>
@endif
