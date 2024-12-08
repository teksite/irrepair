@props(['disabled' => false , 'checked'=>false])

<input type="checkbox" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'accent-blue-800'])!!}
    {{ $checked ? 'checked' : '' }}>
