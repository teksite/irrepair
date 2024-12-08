<aside class="z-50 fixed inset-y-0 start-0 translate-x-full lg:hidden w-full p-0 overflow-hidden transition-all duration-200 ease-in-out border-0 max-w-80 rounded-e-2xl"
       :class="{'translate-x-0 ': sidebar ,  'translate-x-full ' : !sidebar}"
       id="aside-header-menu">
    <div class="flex flex-col w-full bg-slate-50 rounded-e-lg shadow-xl h-full">
        <div class="relative flex gap-3 items-center justify-start min-h-fit h-fit px-3 py-1">
            <div class="">
                <img src="{{'/uploads/logo/parse-300.png'}}" alt="{{__(config('app.name'))}}" width="150" height="67"
                     decoding="sync" fetchPriority="high" loading="eager">
            </div>
            <button  @click="sidebar=false" type="button" role="button"  class="absolute top-1 end-1 rounded-lg border border-slate-400 p-1"
                     aria-controls="aside-header-menu" x-bind:aria-expanded="sidebar" title="{{__('close menu')}}" >
                <i class="tkicon fill-none stroke-black" data-icon="cross" size="16" stroke-width="2"></i>
            </button>
        </div>
        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent">

       <nav class="py-3 ps-3 h-full overflow-y-scroll">
           <x-menus.accordion.menu menu="header-menu-mobile"/>
       </nav>

        <div class="min-h-fit h-fit px-3 pt-1 pb-3 mt-auto mb-0">
            <hr class="h-px mt-0 mb-3 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent">
            <x-input.label for="free-consultant-{{rand(10 , 100)}}" value="{{__('free consultant')}}"/>
            <x-form::layout classForm="mx-auto flex flex-col aligns-stretch" classBtn="w-full" id="1"/>

        </div>
    </div>
</aside>

