<header @click.away="sidebar=false" class="sticky top-0 shadow-lg z-50 transition-transform duration-300 ease-in-out"  id="headerSite">
    <div class="bg-white grid grid-cols-2 lg:grid-cols-12 items-center border-b border-slate-200 px-3 z-30 w-full">
        <div class="lg:col-span-2">
            <a href="/" class="inline-block p-1">
                <img src="{{'/uploads/logo/parse-300.png'}}" alt="{{__(config('app.name'))}}" width="150" height="67"
                     decoding="sync" fetchPriority="high" loading="eager">
            </a>
        </div>
        <nav class="hidden lg:flex lg:col-span-4 items-center">
            <div x-data="{showSearch:false}" class="flex items-center gap-6"  @click.away="showSearch=false">
                <div class="w-full" :class=" !showSearch ? 'block': 'hidden' ">
                    <x-menus.menu menu="header-menu-start"/>
                </div>
                <div id="searchHeader" class="w-full" :class=" showSearch ? 'block': 'hidden' ">
                    <x-search/>
                </div>
                <button type="button" role="button" aria-controls="searchHeader" x-bind:aria-expanded="showSearch"
                        @click="showSearch=!showSearch" :class=" !showSearch ? 'block': 'hidden'" aria-label="{{__('search')}}">
                    <i class="tkicon stroke-gray-900 fill-none" data-icon="magnifier"></i>
                </button>
            </div>

        </nav>
        <div class="lg:col-span-6 flex items-center justify-end gap-6">
           <div class="hidden xl:block">
               <x-form::layout btnTx="ثبت مشاوره رایگان" classBtn="w-fit min-w-fit" classForm="flex items-center items-center mx-auto" id="1"/>
           </div>
            <div class="flex items-center gap-3 ">
                <a href="tel:+982166566062" title="تلفن{{config('app.name')}}"
                   class="hover:text-secondary-700 text-base flex items-center gap-3">
                    <i class="tkicon fill-none stroke-blue-600" size="24" data-icon="phone"></i>

                    <span class="flex flex-col items-center gap-1">
                       <span class="text-xs hidden xl:inline">
                           ساعت پاسخگویی از 9 الی 21
                         </span>
                        <span class="hidden xl:inline" dir="ltr">
                            (+98)(21) 66566062
                        </span>
                    </span>

                </a>
                <a href="https://wa.me/989011200707" class="xl:hidden" title="{{__('free consultant')}} - {{__(config('app.name'))}}">
                    <i class="tkicon fill-none stroke-green-600" size="24" data-icon="whatsapp"></i>
                </a>
            </div>

            <x-profile-button/>
            <x-shop.cart/>
            <button  @click="togglesSidebar()" type="button" role="button" class="lg:hidden" x-bind:aria-expanded="sidebar"
                     aria-controls="aside-header-menu"  x-bind:aria-label="sidebar ? '{{__('close menu')}}' : '{{__('open menu')}}'" x-bind:title="sidebar ? '{{__('close menu')}}' : '{{__('open menu')}}'">
                <i class="tkicon fill-none stroke-blue-600 block border border-blue-600 rounded-lg p-1" size="28" data-icon="bar-3"></i>
            </button>
        </div>
    </div>
    @include('layouts.client.partials.mobile-aside')
</header>
