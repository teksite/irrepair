@props(['route' ,'title'=>null])
<a href="{{$route}}" class="flex items-center justify-center gap-1" title="{{__('edit')}} {{$title}}">
        <i class="tkicon stroke-blue-700 hover:stroke-blue-900 hover:stroke-2" data-icon="paper-pen" size="18"></i>
</a>
