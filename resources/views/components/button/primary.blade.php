<button {{ $attributes->merge(['class' => 'bg-primary-950 text-white rounded mx-auto px-3 py-1 min-w-fit text-center hover:bg-primary-900']) }}>
    {{ $slot }}
</button>
