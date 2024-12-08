@props(['disabled' => false ,'readonly'=>false ,'type'=>'datetime-local'])
@php
    $classes = $disabled ? 'bg-gray-200 cursor-not-allowed ' : 'bg-transparent';
    $errorClass=isset($errors) && !is_null($attributes->get('name')) && $errors->has($attributes->get('name')) ?'!border-red-700':'';
@endphp
<input type="{{$type}}" {{ $readonly ? 'readonly' : '' }} {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => "border border-slate-200 px-3 py-1 rounded-lg focus:outline-2 focus:outline-blue-500  $classes $errorClass" ])!!} >
