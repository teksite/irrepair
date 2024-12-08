@props(['text'=>null ,'href'=>null, 'title'=>null , 'icon'=>null ,'iconSize'=>32])

<a href="{{$href}}" title="{{$title}}" {{$attributes->merge(['class'=>'group aware-position relative overflow-hidden bg-primary-900 text-white font-bold flex items-center gap-3 min-w-fit w-fit border border-gray-700 rounded pt-1 pb-0.5 px-3  z-10'])}}>
    @if($icon)
        <i class="tkicon {{$icon}} fill-none stroke-white" size="{{$iconSize}}"></i>
    @endif
    {{$text}}
        {!! $slot ?? $text!!}
    <span class="effect absolute block {{--translate-x-1/2 translate-y-1/2 --}}-z-10 w-1 h-1 group-hover:scale-150 group-hover:h-[500px] -top-8 -start-8 group-hover:w-[500px] bg-orange-600 rounded-full transition-all duration-300 ease-linear" ></span>
</a>
