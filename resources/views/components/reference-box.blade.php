@props(['title'=>null ,'link'=>null ,'linkText'=>null ,'target'=>'_black' ,'logo'=>null])
<div {{$attributes->merge(['class'=>'x-box  flex flex-col justify-between !border-t-8 !border-t-primary-900'])}}>

    <div class="h-full flex flex-col justify-between">
        <span class="mb-2 strong font-bold text-xl text-blue-600">
            <strong>
                {{$title}}
            </strong>
        </span>
            <p class="!mb-1">
                {!! $slot ?? '' !!}
            </p>

        @if($link)

            <div class="">
                <hr class="my-1">
                <div class="flex items-center justify-between gap-1">
                    <span class="p text-sm">منبع:</span>
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{$link}}" class="hover:text-secondary-600 text-sm font-bold" hreflang="en" rel="rel" target="{{$target}}">
                            {{$linkText}}
                        </a>
                        @if($logo)
                            <img src="{{$logo}}" alt=" {{$linkText}}" width="35" height="35" loading="lazy" fetchpriority="low" decoding="async">
                        @endif
                    </div>

                </div>
            </div>
        @endif

    </div>
</div>
