@props(['route' ,'title'=>null])
<a href="{{$route}}" class="flex items-center justify-center gap-1" title="{{__('save')}} {{$title}}" {{$attributes->except('href')->merge()}}>
        <i class="tkicon stroke-sky-700 hover:stroke-sky-900 hover:stroke-2" data-icon="box-arrow-in" size="18"></i>
</a>
