@props(['active'=>false,  'icon'=>'circle' ,'badge'=>null])

@php
    $classes = ($active ?? false)
    ? 'font-bold leading-5 text-gray-900 active-link actives'
    : 'font-base leading-5 text-gray-400 hover:text-gray-700 hover:border-gray-300';
@endphp

<li class="relative">
    <a {{ $attributes->merge(['class' => "$classes text-sm flex gap-3 w-full items-center px-1 py-2 transition duration-150 ease-in-out"]) }}>
        @if($icon)
            <i class="relative z-10 border tkicon border-slate-400 rounded-full p-0.5 {{$active ? '!fill-gray-800 active': 'fill-none stroke-slate-400  '}}" data-icon="{{$icon}}" size="12"></i>
        @endif
        {{ $slot }}
        @if($badge)
            <span class='leading-none text-xs bg-red-600 w-1 h-1 p-0.5 rounded aspect-square text-white'>{{$badge}}</span>
       @endif
    </a>
    <span class="absolute h-[1.75rem] z-0 w-0.5 bg-slate-200 -top-4 start-2"></span>
</li>
