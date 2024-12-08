<x-client-layout :seo="$seo">
    <x-slot name="editAddressPage">{{route('admin.appearance.theme.edit')}}</x-slot>
    <main id="page-content" class="homePage">
        <section class="bg-slate-50 ">
            <div class="w-11/12 max-w-screen-2xl mx-auto ">
                <div class="p-6 grid gap-6 md:grid-cols-2 items-center">
                    <div>
                        <h1>
                            آموزشگاه انستیتو ایزایران
                        </h1>
                        <p class="">
                            <span class="text-zinc-800 font-bold text-2xl">
                                مرجع آموزش الکترونیک ایران
                            </span>
                        <br>
                            با ارائه دوره‌های متنوع و کاربردی، فرصتی برای توسعه مهارت‌های شما جهت
                            <mark>ورود به بازار کار</mark>
                             ایجاد کرده
                            است. همراهی با ما یعنی ورود به دنیای دانش و مهارت، با اساتید برجسته و محتوای آموزشی به‌روز
                            برای موفقیت در مسیر حرفه‌ای شما.
                        </p>
                    </div>
                    <div>
                        <img src="/uploads/images/pages/homepage.png" alt="آموزشگاه انستیتو ایزایران" loading="lazy"
                             decoding="sync" fetchpriority="high">
                    </div>
                </div>

                <div class="p-6 grid gap-6 lg:grid-cols-2 items-start">
                    <div>
                        @php($product=\Modules\Shop\Models\Product::find(1))
                        <x-box class="bg-white">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="font-bold min-w-fit w-fit text-sm md:text-lg">{{$product->title}}</span>
                                <hr class="border-dashed w-full">
                                <a href="{{$product->path()}}"
                                   class="w-fit min-w-fit regular font-bold text-sm md:text-md">
                                    مشاهده دوره
                                </a>

                            </div>
                            <div class="flex flex-col md:flex-row items-center gap-3">
                                <div class="w-full">
                                    <img src="{{$product->featured_image}}" alt="{{$product->title}}" loading="lazy"
                                         decoding="sync" fetchpriority="high" width="900" height="506">
                                </div>
                                <div class="w-full">
                                    @if($product->price_offline_regular)
                                        <div class="border rounded-lg border-slate-200 border-dashed p-3 mb-3">
                                 <span class="h4 text-gray-600">
                                     قیمت دوره حضوری
                                 </span>
                                            <div class="flex items-center gap-3">
                                                @if($product->price_offline_sell)
                                                    <del class="text-gray-400 front-bold text-xl">
                                                        {{number_format($product->price_offline_regular)}}
                                                    </del>
                                                    <span class="text-gray-900 front-bold text-lg font-bold">
                                             {{number_format($product->price_offline_sell)}}
                                        </span>
                                                @else
                                                    <span>
                                   {{number_format($product->price_offline_regular)}}
                               </span>
                                                @endif
                                                <span class="text-xl font-bold text-gray-400">تومان</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if($product->price_online_regular)
                                        <div class="border rounded-lg border-slate-200 border-dashed p-3 mt-3">
                           <span class="h4 text-gray-600">
                               قیمت دوره مجازی
                           </span>
                                            <div class="flex items-center gap-3">
                                                @if($product->price_online_sell)
                                                    <del class="text-gray-400 front-bold text-xl">
                                                        {{number_format($product->price_online_regular)}}
                                                    </del>
                                                    <span class="text-gray-900 front-bold text-lg font-bold">
                                            {{number_format($product->price_online_sell)}}
                                    </span>
                                                @else
                                                    <span class="text-gray-900 front-bold text-lg font-bold">
                                   {{number_format($product->price_online_regular)}}
                               </span>
                                                @endif
                                                <span class="text-xl font-bold text-gray-400">تومان</span>

                                            </div>

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </x-box>
                    </div>
                    <div class=" p-6">
                        <div class="mb-3 ">
                            <h2 class="text-center">
                                در سراسر ایران در کنار شما
                            </h2>
                            <p class="text-center">
                                جهت دریافت مشاوره رایگان شماره تماس خود را در کادر زیر وارد نمایید و منتظر تماس مشاورین
                                ما باشید.
                            </p>
                            <x-form::layout classBtnBox="block" btnTx="ثبت مشاوره رایگان" classBtn="w-full"
                                            classForm="bg-white  mx-auto" id="1"/>
                        </div>
                        {{--
                                                <div class="flex items-center gap-6 p-3 rounded-b-xl border border-slate-200 inner-container">
                                                    <a href="https://wa.me/989011200707">
                                                        <i class="tkicon fill-none stroke-secondary-900" data-icon="whatsapp"></i>
                                                    </a>
                                                    <a href="tel:+982166566062" title="تلفن">
                                                        <i class="tkicon fill-none stroke-secondary-900" data-icon="phone"></i>

                                                    </a>
                                               </div>
                        --}}
                    </div>
                </div>
            </div>
        </section>
        <section class="py-24 bg-slate-50">
            <div class="inner-container ">
                <h2 class="text-center">
                    دوره های پرطرفدار موسسه
                </h2>
                <ul class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-12">
                    @foreach(\Modules\Shop\Models\Product::all(['title','id' ,'slug' , 'featured_image']) as $product)
                        <li class="p-3 rounded-lg border border-slate-200 hover:bg-white">
                            <a href="{{$product->path()}}">
                                <figure class="text-center">
                                    <img class="block mb-3" src="{{$product->featured_image}}"
                                         alt="{{$product->title}} {{__(config('app.name'))}}" loading="lazy"
                                         decoding="async" fetchpriority="low">
                                    <figcaption>
                                        {{$product->title}}
                                    </figcaption>
                                </figure>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

    </main>
</x-client-layout>
