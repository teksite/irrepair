@props(['color'=>'blue'])
@php
if($color== 'blue'){
        $classes="text-blue-700 hover:bg-blue-700 hover:text-white";
}elseif($color== 'red'){
     $classes="text-red-700 hover:bg-red-700 hover:text-white";
}

@endphp
<button {{ $attributes->merge(['type' => 'submit', 'class' =>"$classes bg-transparent px-3 py-1 rounded-lg transition-colors ease-linear"]) }}>
    {{ $slot }}
</button>
