@props(['color'=>'blue'])
@php
if($color== 'blue'){
        $classes="text-blue-700 hover:bg-blue-700 hover:text-white border-blue-700";
}elseif($color== 'red'){
     $classes="text-red-700 hover:bg-red-700 hover:text-white border-red-700";
}

@endphp
<button {{ $attributes->merge(['type' => 'submit', 'class' =>"$classes border bg-transparent px-3 py-1 rounded-lg transition-colors ease-linear"]) }}>
    {{ $slot }}
</button>
