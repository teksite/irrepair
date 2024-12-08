@props(['menu','items'])
@php($random=rand(100,999))

@if($items->count())
    <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-cloak  x-init=" window.addEventListener('resize', () => dropdownOpen = false)"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="translate-y-2"
         x-transition:enter-end="translate-y-0"
         :class="dropdownOpen ? '' : 'hidden'" style="display: none;"
         class="absolute z-20  inset-x-0 w-11/12 2xl:w-2/3 mx-auto top-10 border rounded-lg shadow-md border-neutral-200/70 mt-5 text-sm bg-white">
        <div class="mx-auto flex " x-data="{menu:0}">
            <div class="min-w-fit w-fit">
                <x-menus.mega-tab.level-1 :items="$items"/>
            </div>
            <div class="w-full px-6 py-2 border-s border-slate-200">
                <x-menus.mega-tab.level-2 :items="$items"/>
            </div>
        </div>
    </div>
@endif


