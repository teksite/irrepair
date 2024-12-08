@props(['label'])
@php
$widget=\Modules\Widget\Models\Widget::firstWhere('label' ,$label);
@endphp
@if($widget)
<div {{$attributes->merge()}}>
    {!! $widget->body !!}
</div>
@endif
