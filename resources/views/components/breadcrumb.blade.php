@props(['items'=>[] , 'home'=>true])
@if(count($items))
    <ol {!! $attributes->merge(['class'=>'font-bold breadcrumb flex flex-wrap items-center gap-x-3 gap-y-1']) !!} itemscope itemtype="https://schema.org/BreadcrumbList">
        @if($home)
            <li class="breadcrumb-item flex items-center gap-3 after:content-['>']" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="/" itemprop="item" class="fill-white transition-all duration-600 flex items-center gap-1 hover:text-secondary-600">
                    <i class="tkicon stroke-current" size="18" data-icon="home"></i>
                    <span itemprop="name">{{__('home page')}}</span>
                </a>
                <meta itemprop="position" content="1"/>
            </li>
        @endif
        @foreach($items as $title=>$url)
            @if(!$loop->last)
                <li class="breadcrumb-item flex items-center gap-3 after:content-['>']" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{!! $url !!}" itemprop="item" class="fill-white transition-all duration-150 flex items-center gap-1 hover:text-secondary-600 hover:fill-secondary-600">
                        <span itemprop="name">{{$title}}</span>
                    </a>
                    <meta itemprop="position" content="{{$home ? $loop->index + 2 : $loop->index + 1}}"/>
                </li>
            @else
                <li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name" class="text-zinc-400">{{$title}}</span>
                    <meta itemprop="position" content="{{$home ? $loop->index + 2 : $loop->index + 1}}"/>
                </li>
            @endif
        @endforeach
    </ol>

@endif
