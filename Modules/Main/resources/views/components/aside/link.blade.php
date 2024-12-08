@props(['title','href', 'icon'=>null ,'active'=>false ,'iconClass'=>'fill-none stroke-indigo-600' ,'badge'=>null])

@php
    $classes = ($active ?? false)
    ? 'bg-white shadow-lg rounded-lg bg-gray-50 hover:bg-gray-100 active-link active'
    : 'bg-transparent hover:bg-gray-100';
@endphp

<li>
    <a class="py-3 w-full my-3 flex items-center gap-3 {{$classes}} {{$active ? 'active' :''}}" href="{{$href}}">
        @isset($icon)
            <i class="tkicon {{$iconClass}}" data-icon="{{$icon}}"></i>
        @endisset
        <span
            class="text-sm leading-5 text-menu {{$active ? 'font-bold text-gray-900 ' : 'font-medium text-gray-600'}}">
            {!! __($title) !!}
        </span>
        @if($badge)
            <span class='text-xs bg-red-600 w-5 h-5 p-0.5 rounded-full aspect-square text-white flex items-center justify-center'>{{$badge}}</span>
        @endif

    </a>
</li>
