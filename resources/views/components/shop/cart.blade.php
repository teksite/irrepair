@auth()
    <a href="{{route('cart.show')}}" class="relative">
        <i class="tkicon fill-none stroke-primary-900" data-icon="bag"></i>
        <span class="absolute bg-red-600 text-gray-200 text-xs p-1 rounded-full w-4 h-4 top-0 -start-1/2 flex items-center justify-center" id="cartBadge">
        {{auth()->user()?->cart->products_count ?? 0}}
    </span>
    </a>

@endauth
