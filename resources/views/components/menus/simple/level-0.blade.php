@props(['menu','items'])
@if($items->count())
    <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-cloak x-transition:enter="ease-out duration-200" x-transition:enter-start="translate-y-2" x-transition:enter-end="translate-y-0" :class="dropdownOpen ? 'block' : 'hidden'"
         class="absolute z-10 -translate-x-1/2 end-0 top-10 w-64 border rounded-lg shadow-md border-neutral-200/70 p p-2 mt-1 text-sm bg-white" style="display: none;">
        <x-menus.simple.level-1 :items="$items" />
    </div>
@endif
