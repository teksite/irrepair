@props(['items'])
@if($items->count())
    <hr>
    <ul class="space-y-3 mt-3">
        @foreach($items as $item)
            <li class="hover:bg-neutral-100 flex items-center">
                <a {{$item->url ? "href=$item->url" :''}}
                   class="{{$item->classes}} w-full block  {{'/'.request()->path() == $item->url ? 'active-menu-item' : ''}}">
                   <span class="relative flex justify-between w-full items-center rounded ">
                        @if($item->pre_icon)
                           <i class="inline-block tkicon fill-none stroke-sky-600" data-icon="{{$item->pre_icon}}"></i>
                       @endif
                       @if($item->image)
                           <figure class="flex items-center gap-3 flex-col justify-center">
                                        <img src="{{$item->image}}" alt="{{$item->title}}" width="300" height="200"
                                             class="w-full h-auto">
                                   <figcaption class="btn-solid-primary"> {{ $item->title }}</figcaption>
                                </figure>
                       @else
                           <span class="px-3">{{ $item->title }}</span>
                       @endif
                       @if($item->next_icon)
                           <i class="inline-block tkicon fill-none stroke-sky-600" data-icon="{{$item->next_icon}}"></i>
                       @endif
                   </span>
                    @if($item->subtitle)
                        <span class="subtitle text-xs font-medium p">{!! $item->subtitle !!}</span>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
@endif
