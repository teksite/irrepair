@props(['route' ,'title'=>null])
@php($randomId='instance-'.rand(123,987).'-form')
<form method="POST" id="form-{{$randomId}}" action="{{$route}}">
    @csrf  @method('DELETE')
</form>
<a href="{{$route}}" class="flex items-center justify-center gap-1 delete-item-btn " title="{{__('delete')}} {{$title}}" data-target="form-{{$randomId}}">
    <i class="tkicon stroke-red-700 hover:stroke-red-900 fill-none hover:stroke-2" data-icon="trash" size="18"></i>
</a>


