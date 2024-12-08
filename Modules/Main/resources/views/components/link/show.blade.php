@props(['route' ,'title'=>null , 'blank'=>true])
<a href="{{$route}}" class="flex items-center justify-center gap-1" title="{{__('show')}} {{$title}}" {{$blank ? 'target=_blank' :''}}>
    <i class="tkicon stroke-green-700 hover:stroke-green-900 fill-none hover:stroke-2" data-icon="eye"></i>
</a>
