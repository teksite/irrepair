<button {{ $attributes->merge(['class' => 'text-indigo-600 border border-indigo-600 py-2 rounded-lg transition-colors ease-linear shadow-lg block w-full']) }}>
    {{ $slot }}
</button>
