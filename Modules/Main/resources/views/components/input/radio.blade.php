@props(['disabled' => false , 'checked'=>false])

<input type="radio" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'accent-green-800'])!!} {{ $checked ? 'checked' : '' }}>
