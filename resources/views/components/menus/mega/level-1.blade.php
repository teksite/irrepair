@props(['menu','items'])

@if($items->count())
    <ul class="grid grid-cols-4 gap-6 xl:gap-12 px-3 mx-auto">
        @foreach($items as $index=>$item)
            <li class="{{$item->children()->count() ? 'group' :''}} {{$item->classes}}">
                <a {{$item->url ? "href=$item->url" :''}} class="relative flex justify-between w-full select-none group items-center rounded px-2 py-1.5 {{$item->url ? 'hover:bg-neutral-100' : 'text-gray-400'}}">
                    @if($item->pre_icon)
                        <i class="inline-block tkicon fill-none stroke-sky-600" data-icon="{{$item->pre_icon}}"></i>
                    @endif
                        @if($item->image)
                            <figure class="flex items-center gap-3 flex-col justify-center">
                                <img src="{{$item->image}}" alt="{{$item->title}}" width="300" height="200"
                                     class="w-full h-auto">
                                <figcaption class="menu-btn"> {{ $item->title }}</figcaption>
                            </figure>
                        @else
                            {{ $item->title }}
                        @endif
                    @if($item->next_icon)
                        <i class="inline-block tkicon fill-none stroke-sky-600" data-icon="{{$item->next_icon}}"></i>
                    @endif
                </a>
                @if($item->subtitle)
                    <span class="subtitle text-sm p">{!! $item->subtitle !!}</span>
                @endif

                <x-menus.mega.level-2 :items="$item->children"/>
            </li>
        @endforeach
    </ul>
@endif
