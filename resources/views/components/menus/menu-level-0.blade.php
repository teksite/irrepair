@props(['menu','items'])
<ul class="flex gap-3 items-center menu-list main-menu-list {{$menu->classes}}">
    @foreach($items as $item)
        <li class="menu-item {{str_contains($item->classes , 'mega-menu')  ?: 'relative '}}" x-data="{ dropdownOpen: false }">
            <a {{$item->url ? "href=$item->url" :""}} @scroll.window="dropdownOpen = false" @click="dropdownOpen = true ;" class="select-none relative cursor-pointer inline-flex gap-1 items-center justify-center h-10 px-3 py-2 text-md font-medium transition-colors rounded menu-link {{'/'.request()->path() == $item->url ? 'current-url active text-secondary-600' : '' }} {{$item->children()->count() ? 'has-child' : '' }}" >
                {!! $item->title !!}
                @if($item->children()->count())
                    <i class="tkicon fill-none stroke-gray-900 transition-all duration-75" :class="{'-rotate-90' : dropdownOpen}" size="10" stroke-width="2" data-icon="angle-left"></i>
                @endif
                <span x-show="dropdownOpen" class="bg-secondary-600 w-full h-0.5 absolute -bottom-1 inset-x-0"></span>
            </a>
            @if($item->children->count())
                @if(str_contains($item->classes , 'mega-menu-col'))
                    <x-menus.mega-tab.level-0 :items="$item->children" :menu="$menu"/>
                @elseif(str_contains($item->classes , 'mega-menu'))
                    <x-menus.mega.level-0 :items="$item->children" :menu="$menu"/>
                @else
                    <x-menus.simple.level-0 :items="$item->children" :menu="$menu"/>
                @endif
            @endif
        </li>
    @endforeach
</ul>
