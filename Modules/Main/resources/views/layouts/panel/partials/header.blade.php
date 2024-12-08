<header class="mb-6 p-3 flex justify-between">
        <div class="flex gap-1 items-center tp font-bold text-white">
            <i class="tkicon icon fill-none stroke-gray-200" data-icon="home"></i>
            <span>{{__("user's panel")}} / @yield('title')</span>
        </div>
        <div class="flex items-center justify-end gap-3 text-white">
            <button role="button" type="button" class="stroke-gray-200 xl:hidden" x-data="" x-on:click.prevent="$dispatch('open-aside', 'openSidebar')">
                <i class="tkicon icon fill-none stroke-current" data-icon="bar-3"></i>
            </button>
            <a href="/" class="" title="{{__('visit :title',['title'=>__('website')])}}">
                <i class="tkicon fill-none stroke-gray-200" data-icon="world"></i>
            </a>
        </div>
</header>

