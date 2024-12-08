@props(['disabled' => false , 'multiple'=>false])
<select {{$multiple ? 'multiple' : ''}} {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-white border border-slate-200 px-3 py-1 rounded-lg focus:outline-2 focus:outline-blue-500']) !!}>
    {{$slot}}
</select>
