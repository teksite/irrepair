@props(['route' ,'title'=>null])
<a href="{{$route}}" class="flex items-center justify-center gap-1" title="{{__('show')}} {{$title}}">
    <i class="tkicon stroke-green-700 hover:stroke-cyan-900 fill-none hover:stroke-2" data-icon="reload"></i>
</a>
