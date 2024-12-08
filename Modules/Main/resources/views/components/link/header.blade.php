@props(['href' ,'title', "icon"=>null , 'iconClass'=>'stroke-current'])
@php
    $isActive=$href == request()->fullUrl();
    if($isActive){
        $classHref = "border border-slate-200 shadow inline-block py-1 px-3 rounded-lg p text-base bg-slate-200";
    }else{
        $classHref="border border-slate-200 shadow inline-block py-1 px-3 rounded-lg p text-base font-semibold";

    }

@endphp
<a href="{{$href}}" {{$attributes->merge(['class'=>"$classHref"])}} title="{{$title}}" disabled="{{$isActive}}">
    @if($icon)
        <i class="tkicon {{$iconClass}} fill-none" data-icon="{{$icon}}"></i>
    @endif
    @if($title)
        {{$title}}
    @endif
</a>


