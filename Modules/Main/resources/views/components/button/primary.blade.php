<button {{ $attributes->merge(['class' => 'text-slate-100  bg-gradient-to-r from-indigo-900 to-indigo-600  px-3 py-2 rounded-lg transition-colors ease-linear shadow-lg']) }}>
    {{ $slot }}
</button>
