<x-client-layout :seo="$seo">
    <x-slot name="editAddressPage">{{route('admin.pages.edit',$page)}}</x-slot>
    <main id="page-content" class="contact-page">
        <header class="bg-zinc-800 pt-24  bg-no-repeat bg-cover bg-theme-1">
            <div class="inner-container grid gap-12 md:grid-cols-2">
                <h1 class="text-center self-center">
                    {{$page->title}}
                </h1>
                <div>
                    <img src="{{$page->featured_image}}" alt="{{$page->title}}">
                </div>
            </div>
        </header>
        <section class="mt-12 mb-24 inner-container">
           @if($page->body)
              <div class="mb-12">
                  {!! $page->body !!}
              </div>
           @endif
           <div class="w-full grid lg:grid-cols-2 gap-6 mt-12">
               <div class=" p-6 rounded-2xl border border-transparent">
                   <h2 class="">
                           راه‌های ارتباطی ما و شما
                       </h2>
                   <ul class="space-y-6">
                       <li>
                           <div class="flex gap-3  p-1">
                               <i class="tkicon fill-none stroke-blue-600 p-1" data-icon="marker-location" size="34"></i>
                               <div class="flex flex-col gap-1">
                                   <span class="text-xl font-bold"> آدرس  نمایندگی شماره 94456124</span>
                                   <address>
                                   <a href="https://goo.gl/maps/NBZUyzbHLsb9h5Zd9" target="_blank"
                                      rel="noopener" title="آدرس {{config('app.name')}}"
                                      class="hover:text-secondary-700 text-base leading-8">
                                       میدان انقلاب اسلامی، ابتدای جمالزاده جنوبی ، پلاک ۹۴
                                       <br>
                                       (ساختمان ۱۴۰ – روبروی کوچه شعله ور) -طبقه ۲ واحد ۷
                                   </a>
                                   </address>
                               </div>
                           </div>
                       </li>
                       <li>
                           <div class="flex gap-3  p-1">
                               <i class="tkicon fill-none stroke-blue-600 p-1" size="34" data-icon="phone"></i>
                               <div class="flex flex-col gap-1">
                                   <span class="text-xl font-bold">تلفن تماس</span>
                                   <div class="flex flex-col gap-1">
                                       <a href="tel:+982166566062" title="تلفن{{config('app.name')}}"
                                          class="hover:text-secondary-700 text-base" dir="ltr">
                                           (+98)(21) 66566062
                                       </a>
                                       <a href="tel:+989011200707" title="تلفن{{config('app.name')}}"
                                          class="hover:text-secondary-700 text-base" dir="ltr">
                                           (098) 09011200707
                                       </a>
                                   </div>
                               </div>
                           </div>
                       </li>
                       <li>
                           <div class="flex gap-3  p-1">
                               <i class="tkicon fill-none stroke-blue-600 p-1" size="34" data-icon="mail"></i>
                               <div class="flex flex-col gap-1">
                                   <span class="text-xl font-bold">ایمیل</span>
                                       <a href="mailto:info@ir-repair.com" target="_blank"
                                          title="ایمیل {{config('app.name')}}" class="hover:text-secondary-700 text-base">
                                           info@ir-repair.com
                                       </a>
                               </div>
                           </div>
                       </li>
                       <li>
                           <div class="flex gap-3  p-1">
                               <i class="tkicon fill-none stroke-blue-600 p-1" size="34" data-icon="world"></i>
                               <div
                                   class="">
                                   <span class="text-xl font-bold">شبکه‌های اجتماعی</span>
                                   <nav>
                                       <ul class="flex gap-6 p-1 items-center">
                                           <li>
                                               <a href="https://telegram.me/989011200707"
                                                  title="تلگرام {{config('app.name')}}">
                                                   <i class="tkicon fill-none stroke-blue-600" size="24" data-icon="telegram"></i>
                                               </a>
                                           </li>
                                           <li>
                                               <a href="https://wa.me/989011200707"
                                                  title="واتساپ {{config('app.name')}}">
                                                   <i class="tkicon fill-none stroke-blue-600" size="24" data-icon="whatsapp"></i>
                                               </a>
                                           </li>
                                       </ul>
                                   </nav>
                               </div>
                           </div>
                       </li>
                   </ul>
                   <p class="mt-6">
                      ساعت پاسخگویی از 9 صبح الی 21 همه روزه غیر از روزهای تعطیل
                   </p>
               </div>
               <div class="relative">
                  <iframe width="400" height="600" allowfullscreen="" loading="lazy" title="{{__('google map')}}"
                               src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3238.0478778032384!2d51.40218834722139!3d35.74962795869563!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e06edbc3f6cf1%3A0xaf62ea30e3aab092!2sBarsa%20Novin%20Ray%20Company!5e0!3m2!1sen!2sus!4v1693654180516!5m2!1sen!2sus"
                               class="w-full rounded-xl" referrerpolicy="no-referrer-when-downgrade"></iframe>
               </div>
           </div>
        </section>
    </main>


</x-client-layout>
