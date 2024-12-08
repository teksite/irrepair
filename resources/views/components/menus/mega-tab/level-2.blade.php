@props(['items'])
@if($items->count())
    <div class="h-full">
    @foreach($items as $item)
        @if($item->children->count())
            <ul x-show="menu === {{$loop->index}}" class="grid gap-6 xl:gap-12 @if($item->children->count() < 2) grid-cols-1  @elseif($item->children->count() == 2) grid-cols-2 @else grid-cols-3  @endif">
                @foreach($item->children as $itm)
                    <li>
                        <a {{$itm->url ? "href=$itm->url" :''}}
                           class="w-full block select-none group items-center rounded py-1.5 {{'/'.request()->path() == $itm->url ? 'active-menu-item' : ''}} {{$itm->url ? "hover:bg-neutral-100" : '' }}">
                            <span class="flex items-center gap-3">
                                @if($itm->pre_icon)
                                    <i class="inline-block tkicon fill-none stroke-sky-600" size="16" data-icon="{{$itm->pre_icon}}"></i>
                                @endif

                                @if($itm->image)
                                <figure class="flex items-center gap-3 flex-col justify-center">
                                        <img src="{{$itm->image}}" alt="{{$itm->title}}" width="300" height="200" class="w-full h-auto">
                                   <figcaption class="menu-btn"> {{ $itm->title }}</figcaption>
                                </figure>
                                    @else
                                        {{ $itm->title }}
                                    @endif
                                @if($itm->next_icon)
                                    <i class="inline-block tkicon fill-none stroke-sky-600" size="16" data-icon="{{$itm->next_icon}}"></i>
                                @endif
                            </span>
                            @if($itm->subtitle)
                                <span class="subtitle text-xs p">{!! $itm->subtitle !!}</span>
                            @endif
                        </a>

                        @if($itm->children->count() )
                            <hr class="my-1">
                            <x-menus.mega-tab.level-3 :items="$itm->children"/>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif

    @endforeach
    </div>
@endif
