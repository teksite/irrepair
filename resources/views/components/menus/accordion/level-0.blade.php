@props(['menu','items'])

@php
    $random=rand(1000,9999);
    $currentUrl = '/' . request()->path();
    $selectedMenu=null;
        foreach($items as $index => $item){
            if($currentUrl == $item->url){
              $selectedMenu= $index ;
           } elseif($item->children->contains('url', $currentUrl)){
              $selectedMenu= $index ;
              }
        }
@endphp
<ul class="{{$menu->classes}} space-y-6 divide-y divide-slate-200" x-data="{selected: `{{$selectedMenu}}` }" >
    @if($items->count())
        @foreach($items as $item)
            <li class="p-1 rounded {{$item->classes}}">
                <div class="!m-0">
                    <a {{$item->url ? "href=$item->url" :''}} role="{{$item->url ? 'link' :'button'}}"
                       class="w-full text-start flex items-center justify-between gap-3 text-sm {{'/'.request()->path() == $item->url ? 'active-menu-item' : ''}}"
                       @click="selected !== {{$loop->index}} ? selected = {{$loop->index}} : selected = null"
                       x-bind:aria-expanded="selected =={{$loop->index}} ?? false"
                       aria-controls="aria-accordion-{{$random}}-{{$loop->index}}">
                       <span class="flex items-center justify-start text-base"
                             :class="selected == {{$loop->index}} ? 'text-blue-700 font-bold' : '' ">
                            @if($item->pre_icon)
                               <i class="inline-block tkicon fill-none stroke-sky-600 {{$item->pre_icon}}"></i>
                           @endif
                           {!! $item->title !!}
                           @if($item->next_icon)
                               <i class="inline-block tkicon fill-none stroke-sky-600 {{$item->next_icon}}"></i>
                           @endif
                       </span>
                        @if($item->children->count())
                            <i class="tkicon fill-none stroke-slate-600 transition-all duration-700"
                               :class="{'transform transition-transform -rotate-90': selected == {{$loop->index}}}"
                               size="14" data-icon="angle-left"></i>
                        @endif
                    </a>
                </div>
                @if($item->children->count())
                    <div class="overflow-hidden transition-all max-h-0 duration-700"
                         id="aria-accordion-{{$random}}-{{$loop->index}}" x-ref="container{{$loop->index}}"
                         x-bind:style="selected == {{$loop->index}} ? 'max-height: ' + $refs.container{{$loop->index}}.scrollHeight + 'px' : ''">
                        <ul class="space-y-2 py-3 list-inside list-disc">
                            @foreach($item->children as $itm)
                                <li class="{{$itm->classes}} hover:bg-slate-200">
                                    <a {{$itm->url ? "href=$itm->url" :''}}  class="w-full px-3 py-1 text-sm {{'/'.request()->path() == $itm->url ? 'active-menu-item' : ''}}">
                                        @if($itm->pre_icon)
                                            <i class="inline-block tkicon fill-none stroke-sky-600 {{$item->pre_icon}}"></i>
                                        @endif
                                        {!! $itm->title !!}
                                        @if($itm->next_icon)
                                            <i class="inline-block tkicon fill-none stroke-sky-600 {{$itm->next_icon}}"></i>
                                        @endif
                                    </a>
                                </li>
                        @endforeach
                    </div>
                @endif
            </li>
        @endforeach
    @endif
</ul>
