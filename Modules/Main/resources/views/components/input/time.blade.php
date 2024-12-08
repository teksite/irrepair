@props(['disabled' => false , 'type'=>'date'])
@php
    $clsses = $disabled ? 'bg-gray-200 cursor-not-allowed' : 'bg-white'
@endphp
<input dir="ltr" type="{{$type}}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => "border border-slate-200 px-3 py-2 rounded-lg
focus:outline-2 focus:outline-blue-500  $clsses"])!!}  >
