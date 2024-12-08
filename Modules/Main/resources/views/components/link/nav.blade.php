@props(['href' ,'title', "icon"=>null])

<a href="{{$href}}" {{$attributes->merge(['class'=>"font-bold flex gap-1 items-center text-blue-600 hover:text-blue-900 border border-blue-600 hover:border-blue-900 rounded-lg px-3 py-1"])}} title="{{$title}}">
    @if($icon)
        <i class="tkicon fill-none stroke-current" data-icon="{{$icon}}"></i>
    @endif
    @if($title)
        {{$title}}
    @endif
</a>


