@props(['menu','items'])
@if($items->count())
    <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-cloak
         x-transition:enter="ease-out duration-200" x-transition:enter-start="translate-y-2" x-transition:enter-end="translate-y-0" :class="dropdownOpen ? '' : 'hidden'" style="display: none;"
         class="absolute z-20 inset-x-0 w-11/12 2xl:w-2/3 mx-auto top-10 border rounded-lg shadow-md border-neutral-200/70 p pt-3 pb-6 px-2  mt-5 text-sm bg-white">
        <x-menus.mega.level-1 :items="$items"/>
    </div>
@endif
