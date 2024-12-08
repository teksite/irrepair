@props(['items' , 'loops'=>1])
@if($items->count())
    <ul class="menu-child menu-depth-{{$loops}}">
        @foreach($items as $item)
            <li>
                <a href="{{$item->url}}" class="{{$item->classes}}">
                    {{$item->title}}
                </a>
                <x-menu::client.menu-item :items="$item->children" :loops="$loops + 1"/>
            </li>
        @endforeach
    </ul>
@endif
