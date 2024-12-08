<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-slate-100  bg-blue-500 hover:bg-blue-700 px-3 py-1 rounded-lg transition-colors ease-linear shadow-lg']) }}>
    {{ $slot }}
</button>
