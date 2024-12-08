@props(['menu','items'])

<ul class="menu-list main-menu-list {{$menu->classes}}">
    @foreach($items->sortBy('position') as $item)
        <li class="menu-item relative {{$item->classes}}" x-data="{ dropdownOpen: false }">
            <a  @scroll.window="dropdownOpen = false" @click="dropdownOpen=true" {{$item->url ? "href=$item->url" :''}}
            class="cursor-pointer inline-flex gap-1 items-center justify-center h-10 px-3 py-2 text-sm font-medium transition-colors rounded  menu-link {{'/'.request()->path() == $item->url ? 'current-url active' : '' }} {{$item->children()->count() ? 'has-child' : '' }}">
                {!! $item->title !!}
                @if($item->children()->count())
                    <i class="tkicon angle-left fill-none" size="10"></i>
                @endif
            </a>
            @if($item->children()->count())
                <x-menus.simple.menu-item-level-1 :items="$item->children()->get()" :menu="$menu"/>
            @endif
        </li>
    @endforeach
</ul>
