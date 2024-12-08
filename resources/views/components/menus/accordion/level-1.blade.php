@props(['menu','items'])
@if($items->count())
    <ul>
        @foreach($items as $item)
            <li class="hover:bg-slate-200">
                <a {{$item->url ? "href=$item->url" :''}}  class="block w-full px-8 py-6 text-left text-sm {{'/'.request()->path() == $item->url ? 'active-menu-item' : ''}}">
					<span>
						{{$item->title}}
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
@endif
