<div class="flex flex-col gap-6 items-center justify-center p-3">
    <div class="flex items-center gap-3 text-center">
        <div>
            <h1 class="!mb-0 text-white">
                {{__(config('app.name'))}}
            </h1>
        </div>
       <div class="w-16 bg-white p-1 rounded">
           <x-logo-project :title="__(config('app.name'))" class=""/>
       </div>
    </div>
    <nav class="">
        <ul class="flex items-center justify-center md:justify-end gap-6">
            <li>
                <a href="tel:+989126037279" title="{{__('phone')}}">
                    <i class="tkicon stroke-gray-200 fill-none" data-icon="phone"></i>
                </a>
            </li>
            <li>
                <a href="mailto:info@teksite.net" title="{{__('email')}}">
                    <i class="tkicon stroke-gray-200 fill-none" data-icon="mail"></i>
                </a>
            </li>
            <li>
                <a href="https://wa.me/989960820360" title="{{__('whatsapp')}}">
                    <i class="tkicon stroke-gray-200 fill-none" data-icon="whatsapp"></i>
                </a>
            </li>
            <li>
                <a href="https://instagram.com/teksite_" title="{{__('instagram')}}">
                    <i class="tkicon stroke-gray-200 fill-none" data-icon="instagram"></i>
                </a>
            </li>

        </ul>
    </nav>
</div>
