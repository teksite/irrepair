<div class="pt-24 mb-24 grid md:grid-cols-2 xl:grid-cols-4 md:items-start gap-24 w-11/12 mx-auto text-center lg:text-start">
    <section id="footer-col-1" class="footer-col mx-auto w-full">
        <h2 class="text-white">
            درباره انستیتو
        </h2>
        <p class="text-gray-200">
            انستیتو جوان گستر داده پرداز پارسه نمایندگی انستیتو ایزایران ( نمایندگی شماره ٩۴۴۵۶١٢۴ ) به عنوان مجهزترین و تخصصی ترین مرکز آموزش دوره های تخصصی سخت افزاری شناخته میشود. افتخار ما این است که نماینده انستیتو ایزایران تاسیس شده در سال ۱۳۵۱ باشیم و بتوانیم خدمات آموزشی شایسته به عموم مردم ایران و خانواده نیرو های مسلح ارائه دهیم.
        </p>
    </section>

    <section id="footer-col-2" class="footer-col mx-auto w-full">
        <h3 class="!mb-0 text-gray-200">{{__('quick access')}}</h3>
        <hr class="my-3 border-blue-500">
        <nav>
            <ul class="space-y-3 text-gray-200 list-disc list-inside">

                <li>
                    <a href="/contact-us" class="hover:text-secondary-600">
                        {{__('contact us')}}
                    </a>
                </li>
            </ul>
        </nav>
    </section>

    <section id="footer-col-3" class="footer-col mx-auto w-full">
        <h3 class="!mb-0 text-gray-200">مشاوره رایگان</h3>
        <hr class="my-3 border-blue-500">
        <p class="text-gray-200">
            جهت دریافت مشاوره رایگان، شماره تماس خود را در کادر زیر وارد نمایید و منتظر تماس همکاران ما باشید.
        </p>
        <x-form::layout classForm="flex items-center text-gray-200 items-center mx-auto" id="1"/>
    </section>

    <section id="footer-col-4" class="footer-col mx-auto w-full">
        <h3 class="!mb-0 text-gray-200">{{__('stay in touch with us')}}</h3>
        <hr class="my-3 border-blue-500">
        <div>
            <ul class="my-3">
                <li>
                    <div class="flex gap-3 text-gray-200 p-1 hover:text-secondary-300 items-start">
                       <div class="flex gap-1 mt-1">
                           <i class="tkicon fill-none stroke-current p-1" data-icon="marker-location" size="28"></i>
                           <span class="text-base font-bold">{{__('address')}}:</span>
                       </div>
                        <address>
                            <a href="https://goo.gl/maps/NBZUyzbHLsb9h5Zd9" target="_blank"
                               rel="noopener" title="{{__('address')}} {{__(config('app.name'))}}"
                               class="hover:text-secondary-300 text-base leading-8">
                                میدان انقلاب اسلامی، ابتدای جمالزاده جنوبی ، پلاک ۹۴
                                ( ساختمان ۱۴۰ – روبروی کوچه شعله ور ) - طبقه ۲ واحد ۷
                            </a>
                        </address>

                    </div>
                </li>
                <li>
                    <div class="flex gap-3 text-gray-200 p-1 hover:text-secondary-300 items-start">
                       <div class="flex gap-1 mt-1">
                           <i class="tkicon fill-none stroke-current p-1" data-icon="phone" size="28"></i>
                           <span class="text-base font-bold">{{__('phone')}}:</span>
                       </div>
                       <a href="tel:00982166566062" target="_blank" rel="noopener" title="{{__('phone')}} {{__(config('app.name'))}}" class="text-sm leading-8" dir="ltr">
                           <span class="text-sm">(+98 021)</span> 6656 6062 - 5
                       </a>
                    </div>
                </li>
            </ul>
        </div>
    </section>
</div>

