@props(['text'=>null ,'href'=>null, 'title'=>null , 'icon'=>null ,'iconSize'=>32 , 'color'=>'primary'])
@php
    $classes=match($color){
        'primary'=> 'border border-primary-900 text-primary-900 hover:bg-primary-900  hover:text-white',
        'secondary'=> 'border border-secondary-600 text-secondary-600 hover:bg-secondary-600  hover:text-white',
        'white'=> 'border border-white text-white hover:bg-white hover:text-primary-900'
}
 @endphp
<a href="{{$href}}" title="{{$title}}"
   {{$attributes->merge(['class'=>"$classes transition-all duration-300 ease-linear font-bold flex items-center justify-center gap-3 min-w-fit w-fit rounded-lg pt-1 pb-0.5 px-3"])}}>
    @if($icon)
        <i class="tkicon {{$icon}} fill-none stroke-current" size="{{$iconSize}}"></i>
    @endif
    <span class="text-center"> {!!  $text ?? '' !!}</span>
</a>
