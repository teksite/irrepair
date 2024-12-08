@props(['text' ,'href'=>null, 'title'=>null , 'icon'=>null ,'iconSize'=>32 , 'color'=>'primary'])
@php
    $colors=match($color){
        'secondary'=>'border-secondary-600 bg-secondary-600 hover:bg-blue-800 text-gray-200',
        'green'=>'border-green-600 bg-green-600 hover:bg-blue-800 text-gray-200',
        'yellow'=>'border-yellow-600 bg-yellow600 hover:bg-yellow-800 text-gray-200',
        'blue'=>'border-blue-600 bg-blue-900 hover:bg-blue-800 text-gray-200',
        'white'=>'border-white bg-white hover:bg-gray-200 text-primary-900',
        default=>'border-primary-900 bg-primary-900 hover:bg-primary-800 text-gray-200'
    }
@endphp

<a href="{{$href}}" title="{{$title}}"
    {{$attributes->merge(['class'=>"$colors border transition-all duration-300 ease-linear font-bold inline-flex items-center gap-3 min-w-fit w-fit rounded-lg pt-1 pb-0.5 px-3"])}}>
    @if($icon)
        <i class="tkicon fill-none stroke-current" data-icon="{{$icon}}" size="{{$iconSize}}"></i>
    @endif
    <span> {{$text}}</span>
</a>
