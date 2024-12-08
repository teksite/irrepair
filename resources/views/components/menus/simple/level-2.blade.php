@props(['menu','items'])
@if($items->count())
    <ul @click.away="dropdownOpen=false"
        data-submenu class="group hidden group-hover:block bg-white w-56 border rounded-md shadow-md border-neutral-200/70 absolute top-0 end-0 z-40 me-1 duration-200 ease-out -translate-x-full group-hover:mr-0 ">
        @foreach($items as $item)
            <li class="group hidden group-hover:block hover:bg-neutral-100">
                <a {{$item->url ? "href=$item->url" :''}}
                   class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:text-neutral-900">
                    {!! $item->title !!}
                    @if($item->children()->count())
                        <i class="tkicon fill-none stroke-gray-700" size="10" data-icon="angle-left"></i>
                    @endif
                </a>
                @if($item->children()->count())
                    <x-menus.simple.level-2 :items="$item->children" />
                @endif
            </li>
        @endforeach
    </ul>
@endif
