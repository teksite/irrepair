@props(['text' ,'href'=>null, 'title'=>null , 'icon'=>null ,'iconSize'=>32])

<a href="{{$href}}" title="{{$title ?? $text}}"
    {{$attributes->merge(['class'=>'bg-primary-900 hover:bg-orange-600 transition-all duration-300 ease-linear text-white font-bold flex items-center gap-3 min-w-fit w-fit rounded pt-1 pb-0.5 px-3'])}}>
    @if($icon)
        <i class="tkicon {{$icon}} fill-none stroke-current" size="{{$iconSize}}"></i>
    @endif
    <span> {{$text}}</span>
</a>
