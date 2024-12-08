@props(['items'])
@if($items->count())
    <ul class="space-y-1">
        @foreach($items as $item)
            <li class="hover:bg-neutral-100 hover:text-neutral-900">
                <a {{$item->url ? "href=$item->url" :''}}
                   class="relative inline-flex justify-between select-none group items-center rounded px-2 py-1.5 {{'/'.request()->path() == $item->url ? 'active-menu-item' : ''}}" >
                    @if($item->pre_icon)
                        <i class="inline-block ttkicon fill-none stroke-gray-900 {{$item->pre_icon}}"></i>
                    @endif
                    {!! $item->title !!}
                    @if($item->next_icon)
                        <i class="inline-block tkicon fill-none stroke-gray-900 {{$item->next_icon}}"></i>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
@endif
