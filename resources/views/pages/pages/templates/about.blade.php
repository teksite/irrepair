<x-client-layout :seo="$seo">
    @php
        $features=[
            ['title'=>'دانشجوی آنلاین','prefix'=>"+" ,"data-count-start"=>"0" ,"data-count-end"=>"2400", "data-count-speed"=>"1000"],
            ['title'=>'دانشجوی حضوری','prefix'=>"+" ,"data-count-start"=>"0" ,"data-count-end"=>"1500", "data-count-speed"=>"1000"],
            ['title'=>'دقیقه آموزش','prefix'=>"+" ,"data-count-start"=>"0" ,"data-count-end"=>"2000", "data-count-speed"=>"1000"],
            ['title'=>'پشتیبانی','prefix'=>"+" ,"data-count-start"=>"0" ,"data-count-end"=>"24", "data-count-speed"=>"1000"],
];
    @endphp
    <x-slot name="editAddressPage">{{route('admin.pages.edit',$page)}}</x-slot>

    <main id="page-content" class="about-page">
        <header class="bg-zinc-800 pt-24  bg-no-repeat bg-cover bg-theme-1">
            <div class="inner-container">
                <h1 class="text-center text-white">
                    {{$page->title}}
                </h1>
                {!! $page->body !!}
                <picture class="mx-auto mt-12 block ">
                    <source media="(max-width: 480px)" srcset="/uploads/images/pages/license-isiran-300.jpg" width="300"
                            height="206"/>
                    <source media="(max-width: 720px)" srcset="/uploads/images/pages/license-isiran-400.jpg" width="400"
                            height="275"/>
                    <source media="(max-width: 900px)" srcset="/uploads/images/pages/license-isiran-600.jpg" width="600"
                            height="412"/>
                    <img src="/uploads/images/pages/license-isiran.jpg" alt="مجوز نمایندگی ایزایران"
                         class="mx-auto xl:w-1/2 border-2 border-slate-200 ring-4 ring-zinc-500 ring-offset-8 ring-offset-zinc-800"
                         width="900" height="618" loading="lazy" fetchpriority="low" decoding="async">
                </picture>
            </div>
            <ul class="grid gap-12 grid-cols-2 md:grid-cols-4 justify-center inner-container mt-12">
                @foreach($features as $feature)
                    <li class="">
                        <div
                            class="counterNumber flex flex-col justify-center items-center gap-3"
                            data-count-start="{{$feature['data-count-start']}}"
                            data-count-end="{{$feature['data-count-end']}}"
                            data-count-speed="{{$feature['data-count-speed']}}">

                            <span dir="ltr" class="text-gray-200  text-2xl">
                                {{$feature['prefix']}}
                                <span class="count">
                                    {{$feature['data-count-start']}}
                                </span>
                            </span>
                            <span class="text-bold text-center text-gray-400">
                                    {{$feature['title']}}
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="trapezius bg-white h-24 lg:h-36 bg-no-repeat bg-cover"></div>
        </header>
        <div class="inner-container">
            @isset($extra['about'])
                <section>
                    @isset($extra['about']['title'])
                        <h2 class="text-center inline-block bg-white px-3">
                            {{$extra['about']['title']}}
                        </h2>
                    @endisset
                    @isset($extra['about']['body'])
                        {!! $extra['about']['body'] !!}
                    @endisset
                </section>
            @endisset
            <section class="inner-container my-24">
                <div class="border border-slate-200 pb-12 rounded-lg p-3">
                    <div class="-mt-6 flex items-center justify-center">
                        <h2 class="text-center inline-block bg-white px-3">
                            مشاوره رایگان
                        </h2>
                    </div>
                    <p class="text-center mb-12">
                        جهت دریافت مشاوره رایگان، شماره موبایل خود را در کادر زیر وارد نمایید. همکاران ما در کوتاه‌ترین
                        زمان ممکن با شما تماس خواهند گرفت.
                    </p>
                    <x-form::layout classForm="flex items-center items-center lg:w-1/2 mx-auto" id="1"/>
                    <hr class="my-6 w-3/4 mx-auto">
                    <p class="text-center">
                        در صورت داشتن هرگونه سوال می‌توانید از طریق صفحه "تماس با ما"ُ با همکاران واحد پشتیبانی در
                        ارتباط باشید.
                    </p>
                    <div class="flex flex-col md:flex-row gap-12 justify-center">
                        <a href="/contact-us/" class="regular flex items-center gap-3">
                            <i class="tkicon fill-none stroke-current" data-icon="phone"></i> تماس با ما
                        </a>
                        <a href="/courses/" class="regular flex items-center gap-3">
                            <i class="tkicon fill-none stroke-current" data-icon="book-opened"></i> دوره ها
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>


</x-client-layout>
