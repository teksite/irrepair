@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-transparent border border-slate-200 px-3 py-1 rounded-lg
focus:outline-2 focus:outline-blue-500 '])!!}>{{$slot}}</textarea>
