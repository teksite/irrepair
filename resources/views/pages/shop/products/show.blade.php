<x-client-layout :seo="$seo">
    <x-slot name="editAddressPage">{{route('admin.shop.products.edit',$product)}}</x-slot>
    <div id="page-content" class="about-page">
        <x-banner.trapezius>
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <h1 class="text-white">
                        {{$product->title}}
                    </h1>
                    <span class="block text-gray-400 font-bold text-sm my-4"> {{__(config('app.name'))}}</span>
                    <div class="flex items-center gap-6 flex-1">
                        <a href="#consultant"
                           class="min-w-48 inline-flex items-center gap-3 text-center px-6 py-2 rounded-lg bg-gray-200 text-zinc-800 hover:bg-gray-50 font-bold">
                            <i class="tkicon fill-none stroke-current" data-icon="headset"></i>
                            {{__('free consultant')}}
                        </a>
                        <a href="#priceList"
                           class="min-w-48 inline-flex items-center gap-3 text-center border border-gray-50 px-6 py-2 rounded-lg bg-transparent text-gray-200 hover:bg-gray-50 hover:text-zinc-800 font-bold">
                            <i class="tkicon fill-none stroke-current" data-icon="credit-card"></i>

                            {{__('buy the course')}}
                        </a>
                    </div>
                </div>
                <div class=" relative">
                    <div class="rounded-lg overflow-hidden relative z-10">
                        @if($product->video)
                            <video class="w-full" src="{{$product->video}}"
                                   poster="{{$product->featured_image}}"></video>
                        @else
                            <img class="w-full" alt="{{$product->title}} {{__(config('app.name'))}}"
                                 src="{{$product->featured_image}}" width="600" height="400" loading="lazy"
                                 decoding="sync" fetchpriority="high">
                        @endif
                    </div>
                    <span class="absolute -end-6 -top-6 w-48 h-full bg-zinc-900 z-0 md:inline hidden rounded-xl"></span>
                </div>
            </div>
            <hr class="inner-container my-12">
            <nav class="py-12">
                <ul class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-6 justify-center text-gray-200">
                    <li class="border-2 border-slate-200 p-3 rounded-3xl">
                        <a href="#chapters" class="flex items-center gap-3">
                            <i class="tkicon fill-none stroke-current" data-icon="book-opened"></i>
                            سرفصل‌ها
                        </a>
                    </li>
                    <li class="border-2 border-slate-200 p-3 rounded-3xl ">
                        <a href="#certificates" class="flex items-center gap-3">
                            <i class="tkicon fill-none stroke-current" data-icon="paper-certificate"></i>
                            گواهینامه معتبر
                        </a>
                    </li>
                    <li class="border-2 border-slate-200 p-3 rounded-3xl ">
                        <a href="#support" class="flex items-center gap-3">
                            <i class="tkicon fill-none stroke-current" data-icon="user"></i>
                            پشتیبانی ۶ بعدی
                        </a>
                    </li>
                    <li class="border-2 border-slate-200 p-3 rounded-3xl ">
                        <a href="#workshop" class="flex items-center gap-3">
                            <i class="tkicon fill-none stroke-current" data-icon="briefcase"></i>
                            همراهی تا بازار کار
                        </a>
                    </li>
                    <li class="border-2 border-slate-200 p-3 rounded-3xl ">
                        <a href="#faq" class="flex items-center gap-3">
                            <i class="tkicon fill-none stroke-current" data-icon="question-mark"></i>
                            پاسخ‌گوی شما
                        </a>
                    </li>
                </ul>
            </nav>
        </x-banner.trapezius>
        <main class="">
            <section class="mb-12 content-center min-h-screen-1/2 py-24 inner-container">
                {!! $product->introduction !!}
            </section>
            @if($product->chapters && count($product->chapters))
                <section class="mb-12 min-h-screen-1/2 py-24 bg-slate-50" x-data="{ selected: null }" id="chapters">
                    <div class="inner-container">
                        <i class="mx-auto tkicon fill-none stroke-primary-900 stroke-2 mb-6" size="48"
                           data-icon="book-opened"></i>
                        <h2 class="text-center">
                            سرفصلهای {{$product->title}}
                        </h2>
                        <ul class="accordion-list space-y-3">
                            @foreach ($product->chapters as $chapter)
                                @php($random = rand(100, 999))
                                <li class="border border-slate-200 p-3 rounded bg-white">
                                    <div :class="selected === {{ $loop->index + 1 }} ? 'border-b' : ''">
                                        <button type="button" role="button"
                                                title="{{__('question')}}:  {{ $chapter['title']}}"
                                                class="w-full text-start flex items-center justify-between gap-6 p text-sm "
                                                @click="selected = selected === {{ $loop->index + 1 }} ? null : {{ $loop->index + 1 }}"
                                                :aria-expanded="selected === {{ $loop->index + 1 }}"
                                                :aria-seleced="selected === {{ $loop->index + 1 }}"
                                                aria-controls="aria-accordion-{{ $random }}-{{ $loop->index + 1 }}">
                                    <span class="flex items-center gap-3">
                                        <i class="tkicon fill-none stroke-zinc-900" data-icon="bar-3"></i>
                                    <span class="p px-1 py-2 text-sm">
                                       {{ $chapter['title']}}
                                    </span>

                                    </span>
                                            <i class="tkicon fill-none stroke-zinc-900"
                                               :class="selected ==={{ $loop->index + 1 }} ? '-rotate-90' : ''" size="18"
                                               data-icon="angle-left"></i>
                                        </button>
                                    </div>
                                    <div class="overflow-hidden transition-all max-h-0 duration-700"
                                         id="aria-accordion-{{ $random }}-{{ $loop->index + 1 }}"
                                         x-ref="container{{ $loop->index + 1 }}"
                                         x-bind:style="selected === {{ $loop->index + 1 }} ? 'max-height: ' + $refs.container{{ $loop->index + 1 }}.scrollHeight + 'px' : ''">
                                        <div class="p-3 p">
                                            {!! $chapter['body'] !!}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            @endif
            <section class="inner-container py-24" id="certificates">
                <div class="grid gap-6 md:grid-cols-2 items-center">
                    <div>
                        <h2>
                            مدارک و گواهینامه های قابل اعطا بعد از دوره
                        </h2>
                        <div class=" mb-12">
                            <h3>
                                مدرک فنی حرفه ای
                            </h3>
                            <ul class="list-inside list-disc">
                                <li>گواهینامه بین المللی سازمان فنی و حرفه ای</li>
                                <li>دارای تاییدیه ILO در۱۸۶ کشورجهان</li>
                                <li>امکان ارائه جهت آزمون مربیگری در سطح دنیا</li>
                                <li>امکان ارائه به دادگستری و سفارت جهت ویزای کار</li>
                            </ul>
                        </div>
                        <div>
                            <h3>
                                مدرک نمایندگی انستیتو ایزایران
                            </h3>
                            <ul class="list-inside list-disc">
                                <li>امکان دریافت جواز کسب</li>
                                <li>اولویت ویژه در ارگان های نظامی</li>
                                <li>امکان ارائه به عنوان آموزش ضمن خدمت</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <picture class="mx-auto block">
                            <source media="(max-width: 480px)" srcset="/uploads/images/pages/certificates-300.jpg"
                                    width="300" height="300"/>
                            <source media="(max-width: 720px)" srcset="/uploads/images/pages/certificates-400.jpg"
                                    width="400" height="400"/>
                            <source media="(max-width: 900px)" srcset="/uploads/images/pages/certificates-600.jpg"
                                    width="600" height="600"/>
                            <img src="/uploads/images/pages/certificates.jpg"
                                 alt=" مدارک و گواهینامه های قابل اعطا بعد از دوره" class="" width="900" height="900"
                                 loading="lazy" fetchpriority="low" decoding="async">
                        </picture>
                    </div>
                </div>
            </section>
            <section class="py-24 bg-slate-50" id="facilities">
                <div class="inner-container">
                    <h2 class="text-center">
                        امکانات رفاهی نمایندگی انستیتو ایزایران
                    </h2>
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 items-center">
                        <ol class="list-decimal columns-2">
                            <li>قیمت مناسب</li>
                            <li>کیفیت بالا</li>
                            <li>امنیت بسیار بالا</li>
                            <li>نزدیکی تا موسسه</li>
                            <li>امکان رزرو آنلاین</li>
                            <li>کنسول های بازی PS4 و...</li>
                            <li>بازی جذاب فوتبال دستی</li>
                            <li> بازی جذاب پینگ پونگ</li>
                            <li>اتاق مطالعه اختصاصی</li>
                            <li>خدمات متنوع کافی شاپ پرستیژ</li>
                            <li>محیط های ورزشی متنوع</li>
                        </ol>

                        <div dir="ltr" x-data
                             x-init=" $nextTick(() => { const content = $refs.content; const item = $refs.item;  const clone = item.cloneNode(true); content.appendChild(clone);}); "
                             class="relative w-full container-block lg:col-span-2">
                            <div
                                class="relative w-full py-3 mx-auto overflow-hidden text-lg italic tracking-wide text-white uppercase bg-slate-50 max-w-7xl sm:text-xs md:text-sm lg:text-base xl:text-xl 2xl:text-2xl">
                                <div
                                    class="absolute right-0 z-20 w-40 h-full bg-gradient-to-l from-slate-50 to-transparent"></div>
                                <div x-ref="content" class="flex animate-marquee">
                                    <div x-ref="item"
                                         class="flex items-center justify-around flex-shrink-0 w-full py-2 space-x-2 text-white">
                                        <img src="/uploads/images/pages/sweeming-pool.jpg"
                                             alt=" مدارک و گواهینامه های قابل اعطا بعد از دوره" class="" width="315"
                                             height="315" loading="lazy" fetchpriority="low" decoding="async">
                                        <img src="/uploads/images/pages/lobby.jpg"
                                             alt=" مدارک و گواهینامه های قابل اعطا بعد از دوره" class="" width="315"
                                             height="315" loading="lazy" fetchpriority="low" decoding="async">
                                        <img src="/uploads/images/pages/foodcort.jpg"
                                             alt=" مدارک و گواهینامه های قابل اعطا بعد از دوره" class="" width="315"
                                             height="315" loading="lazy" fetchpriority="low" decoding="async">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="inner-container my-24" id="workshop">
                <div class="mb-24">
                    <h2 class="text-center">
                        نقشه راه دوره ها
                    </h2>
                    <p class="text-center">
                        شما با ثبت شماره خود می توانید به صورت رایگان با کارشناسان ما در ارتباط باشید و بهترین راه را
                        برای خود انتخاب کنید
                    </p>
                    <p class="text-center">
                        همچنین در طول دوره، زمان برگزاری آنها همگی بسته به شما دارد و تا زمانی که مبحثی را فرا نگرفتید
                        مباحث بعدی به شما تدریس نخواهد شد تا زمانی که مشکل شما حل شود.
                    </p>
                    <picture class="mx-auto block">
                        <source media="(max-width: 480px)" srcset="/uploads/images/pages/roadmap-300.jpg" width="300"
                                height="900"/>
                        <source media="(max-width: 720px)" srcset="/uploads/images/pages/roadmap-400.jpg" width="400"
                                height="1200"/>
                        <source media="(max-width: 900px)" srcset="/uploads/images/pages/roadmap-600.jpg" width="600"
                                height="180"/>
                        <img src="/uploads/images/pages/roadmap.jpg" alt="نقشه راه دوره های انستیتو ایزایران"
                             class="w-full" width="900" height="269" loading="lazy" fetchpriority="low"
                             decoding="async">
                    </picture>
                </div>
                <div class="mb-24" id="support">
                    <h2 class="text-center">
                        پشتیبانی ۶ بعدی
                    </h2>
              {{--      <img src="/uploads/images/pages/6d_support.svg" type="image/svg+xml" alt="پشتیبنی 6 بعدی"
                         class="mx-auto" width="600" height="600" loading="lazy" fetchpriority="low" decoding="async">
                    <ul class="flex flex-col lg:flex-row items-center justify-center gap-6 ">
                        <li class="text-center border border-slate-200 p-3 rounded-lg shadow-lg">
                            امکان ثبت تیکت در سامانه پشتیبانی
                        </li>
                        <li class="text-center border border-slate-200 p-3 rounded-lg shadow-lg">
                            پشتیبانی از طریق تلفن و داخلی مخصوص پشتیبان
                        </li>
                        <li class="text-center border border-slate-200 p-3 rounded-lg shadow-lg">
                            ارتباط از طریق تلگرام با پشتیبان ویژه دوره
                        </li>
                        <li class="text-center border border-slate-200 p-3 rounded-lg shadow-lg">
                            ملاقات حضوری با هماهنگی قبلی در دفتر ایزایران با پشتیبان دوره (جلسات نیم ساعته و یک ساعته)
                        </li>
                        <li class="text-center border border-slate-200 p-3 rounded-lg shadow-lg">
                            ارتباط از طریق واتساپ با پشتیبان ویژه دوره
                        </li>
                        <li class="text-center border border-slate-200 p-3 rounded-lg shadow-lg">
                            اتصال به کامپیوتر دانشجو و بررسی مشکل
                        </li>
                    </ul>--}}
                    <x-product.support />

                </div>
            </section>
            <section class="inner-container my-24" id="description">
                <x-reveal-section>
                    <x-slot:intro>
                        <h2>
                            چرا نمایندگی انستیتو ایزایران
                        </h2>
                        <p>
                            نمایندگی انستیتو ایزایران، یکی از برترین آموزشگاه‌های تعمیرات الکترونیک در ایران، با
                            بهره‌گیری از
                            استانداردهای آموزشی برتر و تجربه‌ای موفق در حوزه آموزش‌های تخصصی آی‌تی، دوره‌های آموزش
                            تعمیرات لوارم
                            الکترونیک مانند تعمیر موبایل و تبلت، لپتاپ در تهران را با هزینه مناسب و کیفیت آموزشی بالا
                            برگزار
                            می‌کند. این آموزشگاه با دریافت عنوان برترین آموزشگاه از سوی شورای عالی انفورماتیک کشور،
                            انتخابی
                            ایده‌آل برای یادگیری تعمیرات لوازم الکترونیک و قطعات الکترونیکی است.
                        </p>
                    </x-slot:intro>
                    {!! $product->body !!}

                </x-reveal-section>
            </section>
            <section class="pb-24 bg-slate-50 pt-24" id="priceList">
                <div class="inner-container grid lg:grid-cols-2 gap-6 bg-white p-3 rounded-lg lg:divide-x divide-slate-200">
                    <div class="order-2 p-6">
                      <x-product.price-buy :product="$product"/>
                    </div>
                    <div class="order-1 p-6">
                        <div class="flex gap-3">
                            <span class="flex h-3 w-3 relative mt-3">
                                  <span class="absolute animate-ping inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
                            </span>
                            <h2>
                                ویژگی‌های {{$product->title}}
                            </h2>
                        </div>
                        <ul class="divide-y  divide-dashed divide-slate-200">
                            @foreach($product->getValuesOfAttributes() as $attribute)
                                <li class="flex py-3">
                                   <span class="flex items-center font-bold gap-3">
                                        <i class="tkicon fill-none stroke-secondary-600"
                                           data-icon="{{$attribute['attribute']['icon']}}"></i>
                                    {{$attribute['attribute']['title']}} :
                                   </span>
                                    {{implode(', ',$attribute['values'])}}
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </section>
            <section class="pb-24 bg-slate-50" id="consultant">
                <div class="p-6 rounded-lg bg-white inner-container">
                    <h2 class="text-center">
                        {{__('free consultant')}}
                    </h2>
                    <div class="grid gap-6 lg:grid-cols-2">
                        <div>
                            <p>
                                جهت درخواست فوری مشاوره رایگان می توانید به شماره زیر پیامک دهید
                                <br>
                                <a class="text-xl font-bold"
                                   href="sms:989011200707?body=جهت مشاوره ایزایران با من تماس بگیرد" dir="ltr">
                                    09011200707
                                </a>
                                <br>
                                و یا با شماره زیر تماس حاصل فرمایید.
                                <br>
                                <a class="text-xl font-bold"
                                   href="sms:989011200707?body=جهت مشاوره ایزایران با من تماس بگیرد" dir="ltr">
                                    021-665 660 62
                                </a>
                            </p>
                        </div>
                        <div>
                            <p>
                                همچنین می توانید شماره خود را در کادر زیر وارد کنید و منتظر تماس همکاران ما بمانید.
                            </p>
                            <x-form::layout classBtnBox="block" btnTx="ثبت مشاوره رایگان" classBtn="w-full block" classForm="" id="1"/>

                        </div>
                    </div>
                </div>
            </section>
            <section class="inner-container py-24" id="workshop">
                <h2 class="text-center">
                    تجهیزات کارگاه های نمایندگی انستیتو ایزایران
                </h2>
                <p class="text-center">
                    کارگاه های نمایندگی انستیتو مجهزترین و بروزترین کارگاه های آموزشی کشور می باشد
                </p>
                <div class="inner-container">
                    <div>
                        <div class="h_iframe-aparat_embed_frame">
                            <span style="display: block;padding-top: 57%"></span>
                            <iframe src="https://www.aparat.com/video/video/embed/videohash/x020m9j/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
                        </div>
                    </div>
                    <div class="flex ">
                        <div>
                            <img src="/uploads/images/pages/kargah-1.jpg" width="250" height="250"
                                 alt="کارگاه انستیتو ایزایران" loading="lazy" fetchpriority="low" decoding="async">
                        </div>
                        <div>
                            <img src="/uploads/images/pages/kargah-2.jpg" width="250" height="250"
                                 alt="کارگاه انستیتو ایزایران" loading="lazy" fetchpriority="low" decoding="async">
                        </div>
                        <div>
                            <img src="/uploads/images/pages/kargah-3.jpg" width="250" height="250"
                                 alt="کارگاه انستیتو ایزایران" loading="lazy" fetchpriority="low" decoding="async">
                        </div>
                    </div>

                </div>
            </section>
            <section class="pb-24" id="faq">
                <x-faq.section :faq="$product->faq"/>


            </section>
        </main>
    </div>


</x-client-layout>
