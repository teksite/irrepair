@props(['route' ,'title'=>null])
<a href="{{$route}}" class="flex items-center justify-center gap-1" title="{{__('reply to :title',['title'=>$title])}}">
    <i class="tkicon stroke-green-700 hover:stroke-green-900 fill-none hover:stroke-2" data-icon="comment"></i>
</a>
