@props(['label'])

@php
    $menu=\Modules\Menu\Models\Menu::firstWhere('label', $label);
    $constraint = function ($query) {
        $query->where('parent_id' , 0);
    };

    $items =  \Modules\Menu\Models\MenuItem::where('menu_id', $menu->id)->treeOf($constraint)->get()->toTree();
@endphp

@if($menu && $items->count())
    <ul class="{{$menu->classed}}">
        @foreach($items as $item)
            <li>
                <a href="{{$item->url}}" class="{{$item->classed}}">
                    {{$item->title}}
                </a>
                <x-menu::client.menu-item :items="$item->children"/>
            </li>
        @endforeach
    </ul>
@endif
