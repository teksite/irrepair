@props(['title'=>'title' , 'icon'=>null ,'active'=>false ,'iconClass'=>'fill-none stroke-indigo-600'])

@php
    $classes = ($active ?? false)
    ? 'bg-gray-50 hover:bg-gray-100 active-link active'
    : 'bg-transparent hover:bg-gray-100';
@endphp

<li>
    <div x-data="{open:{{$active ? 'true' :'false'}}}" {{$attributes->merge(['class' => "$classes transition duration-150 ease-in-out"]) }}>

        <button @click="open=!open" x-bind:title="open ? '{{__('close :title menu',['title'=>$title])}}' : '{{__('open :title menu',['title'=>$title])}}'" type="button" role="button"
                class="py-3 px-1 w-full flex items-center gap-3 relative z-10 active {{$active ? ' bg-white shadow-lg rounded-lg' :''}}">
            @isset($icon)
                <i class="tkicon  {{$iconClass}} {{$active ? 'active' :''}}" data-icon="{{$icon}}"></i>
            @endisset
            <span class="text-sm leading-5 text-menu {{$active ? 'font-bold text-gray-900' : 'font-medium text-gray-600'}}">
            {{__($title)}}
        </span>
            <i :class="{'-rotate-90':open , '!rotate-0':!open}" class="tkicon ease-in-out transition-all me-0 ms-auto icon-accordion fill-none stroke-gray-900" size="9" data-icon="angle-left"></i>
        </button>
        <div x-show="open" x-cloak class="px-1 " x-transition>
           <ul>
               {{$slot}}
           </ul>
        </div>
    </div>

</li>
