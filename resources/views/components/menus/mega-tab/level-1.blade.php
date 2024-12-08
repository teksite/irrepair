@props(['items'])
@if($items->count())
    <ul class="border-e border-slate-200 divide-y divide-slate-200 ">
        @foreach($items as $item)
            <li class="flex justify-start ">
                <div class="w-full hover:bg-neutral-100" :class="{'bg-neutral-100' : menu == {{$loop->index}}}">
                    <a {{$item->url ? "href=$item->url" :''}}
                       class="relative flex gap-1 justify-start w-full select-none group items-center rounded p-6" :class="menu =={{$loop->index}} ? 'active-item' : ''"
                       @click.prevent="menu ={{$loop->index}}">
                        @if($item->pre_icon)
                            <i class="inline-block tkicon fill-none stroke-sky-600" data-icon="{{$item->pre_icon}}"></i>
                        @endif
                        {!! $item->title !!}
                        @if($item->next_icon)
                            <i class="inline-block tkicon fill-none stroke-sky-600" data-icon="{{$item->next_icon}}"></i>
                        @endif
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
@endif
