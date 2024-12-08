@props(['text' ,'href'=>null, 'title'=>null , 'icon'=>null ,'iconSize'=>32 , 'color'=>'primary'])


<a href="{{$href}}" title="{{$title}}" {{$attributes->merge(['class'=>' rounded-lg bg-primary-900 p-3 overflow-hidden relative group transition-all duration-700 text-center text-white font-bold flex items-center gap-6 relative leading-0 z-20'])}}>
    @if($icon)
        <i class="tkicon fill-none stroke-gray-200" size="32" data-icon="{{$icon}}"></i>
    @endif
    <span class="relative z-20"> {{$text}}</span>
    <spa class="transition-all duration-700 ease-in-out bg-secondary-600 h-full w-0 group-hover:w-full absolute z-10 top-0 start-0"></spa>
</a>
