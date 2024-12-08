@props(['disabled' => false])
@php
    $errorClass=isset($errors) && !is_null($attributes->get('name')) && $errors->has($attributes->get('name')) ?'!border-red-700':'';
@endphp
<input  type="file" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => "text-sm cursor-not-allowed file:me-3 file:rounded-md file:border-0 file:bg-primary-500 file:py-2 file:px-3 file:text-sm file:font-semibold file:text-white hover:file:bg-primary-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60 $errorClass" ])!!} />
