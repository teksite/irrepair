@props(['items'])
@if($items->count())
    <ul class="grid gap-6 xl:gap-12 @if($items->count() <= 2) grid-cols-2  @elseif($items->count() == 3) grid-cols-3  @else grid-cols-4 @endif">
        @foreach($items as $item)
            <li class="">
                <a {{$item->url ? "href=$item->url" :''}}
                   class="relative inline-flex justify-between select-none group items-center rounded px-2 py-1.5 {{'/'.request()->path() == $item->url ? 'active-menu-item' : ''}} {{$item->url==null ? 'text-gray-400 ' :' hover:bg-neutral-100 '}}" >
                    @if($item->pre_icon)
                        <i class="inline-block ttkicon fill-none stroke-gray-900 {{$item->pre_icon}}"></i>
                    @endif
                    {!! $item->title !!}
                    @if($item->next_icon)
                        <i class="inline-block tkicon fill-none stroke-gray-900 {{$item->next_icon}}"></i>
                    @endif
                </a>
                @if($item->children->count() )
                    <x-menus.mega-tab.level-4 :items="$item->children"/>
                @endif
            </li>
        @endforeach
    </ul>
@endif
