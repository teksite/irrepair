@props(['faq'])
{{--FAQ--}}
@if(count($faq) )
    <section class="my-12 pt-12 pb-12 inner-container">
        <h2 class="text-center">
            سوالات متداول
        </h2>
       <div class="grid gap-6 lg:grid-cols-3 ">
           <div>
               <picture class="mx-auto block">
                   <source media="(max-width: 1024px)" srcset="/uploads/images/pages/faq-d.jpg"
                           width="600" height="600"/>
                   <img  src="/uploads/images/pages/faq.jpg" alt="سوالات متداول" class="mx-auto" width="400" height="400" loading="lazy" fetchpriority="low" decoding="async">
               </picture>

           </div>
           <div class="lg:col-span-2">
               <x-faq.accordion :data="$faq" active="0"/>
           </div>
       </div>
    </section>
@endif
