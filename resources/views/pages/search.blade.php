<x-client-layout :seo="$seo">
    @php
        $in =request()->in ?? (isset($data['builder']) ? array_key_first($data['builder']) : null);
 @endphp
    <main>
        <section class="inner-container my-12">
            <h1>
                {{__('search')}}
            </h1>
            @isset($data['count'])
                <nav>
                    <ul class="flex items-center gap-3">
                        @foreach($data['count'] as $title=>$count)
                            <li>
                                <a {{$count > 0 ? "href=".request()->fullUrlWithQuery(['in'=>$title]) : ''}} disabled="{{$count == 0}}"
                                   class="{{$count ==0 ?:'!text-green-600 font-bold'}} {{$in ==$title ? 'bg-gray-300' : '' }} regular px-3 py-1 rounded-lg border border-slate-200">
                                    {{__($title)}} ({{$count}})
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endisset
            <div class="my-6">
                <div class="p-3 border border-slate-200 rounded-lg">
                    <form action="" method="GET">
                        <div class="flex items-stretch ">
                            <label for="searchInput" class="w-16 aspect-square flex items-center justify-center p">
                                <i class="tkicon fill-none icon stroke-current" data-icon="magnifier"></i>
                            </label>
                            <x-input.text id="searchInput" aria-label="{{__('search')}}" class="block w-full border-2 !rounded-e-none"
                                          name="s" placeholder="جستجو کنید ..." value="{{request()->s ?? ''}}"/>
                            <x-button.primary class="text-sm w-32 !rounded-s-none" type="submit">{{__('search')}}</x-button.primary>
                        </div>
                    </form>
                </div>
            </div>
            @if(isset($data['builder']))

                <div class="my-12">
                    @if($in && isset($data['builder'][$in]))
                        <ul class="grid gap-12 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                            @foreach(($data['builder'][$in])->paginate(20) as $result)
                                <li>
                                    <x-box class="overflow-hidden !p-0 h-full flex flex-col justify-between">
                                        @if($result->avatar || $result->featured_image || $result->icon || $result->logo)
                                            <img src="{{$result->avatar ?? $result->featured_image ?? $result->icon ?? $result->logo}}"
                                                 alt=" {{$result->title ?? $result->name}}"  width="400"
                                                 height="300" loading="lazy" fetchPriority="low" decoding="async">
                                        @endif

                                        <div class="p-3">
                                        <span class="flex items-center text-center mx-auto p font-bold text-sm">
                                            {{$result->title ?? $result->name}}
                                        </span>
                                        </div>
                                        <div class="p-3">

                                            @if(method_exists($result,'path') && $result->path())
                                                <a href="{{$result->path()}}" class="regular">
                                                    مشاهده
                                                </a>
                                            @endif
                                        </div>
                                    </x-box>

                                </li>

                            @endforeach

                        </ul>
                        <div dir="rtl" class="my-6">
                            {!! ($data['builder'][$in])->paginate(20)->appends($_GET)->links() !!}
                        </div>
                    @endif

                </div>
            @else
                <p class="text-center">{{__('no item has found')}}</p>
            @endif

        </section>

    </main>

</x-client-layout>
