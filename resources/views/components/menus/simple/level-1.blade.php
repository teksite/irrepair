@props(['items'])
@if($items->count())
    <ul class="space-y-3">
        @foreach($items as $item)
            <li class="{{$item->children->count() ? "relative group" :''}} hover:bg-neutral-100">
                <a {{$item->url ? "href=$item->url" :''}}
                   class="relative flex justify-start w-full cursor-pointer select-none group items-center rounded px-2 py-1.5 {{'/'.request()->path() == $item->url ? 'active-menu-item' : ''}}">
                    {!! $item->title !!}
                    @if($item->children()->count())
                        <i class="tkicon fill-none stroke-gray-700" size="10" data-icon="angle-left"></i>
                    @endif
                    @if($item->subtitle)
                       <span class="text-xs">
                            {!! $item->subtitle !!}
                       </span>
                    @endif
                </a>
                @if($item->children()->count())
                    <x-menus.simple.level-2 :items="$item->children" />
                @endif
            </li>
        @endforeach
    </ul>
@endif
