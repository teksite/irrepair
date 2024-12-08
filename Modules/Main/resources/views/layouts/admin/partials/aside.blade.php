@php use Nwidart\Modules\Facades\Module; @endphp
<aside class="xl:translate-x-0 xl:mx-3 fixed inset-y-0 start-0 block w-full p-0 py-3 overflow-hidden transition-all duration-200 ease-in-out border-0 z-10 max-w-64 rounded-2xl"
       id="aside-admin-menu" :class="sidebar ? 'translate-x-full xl:translate-x-0  xl:mx-3' : 'translate-x-0 xl:translate-x-full xl:mx-3'">
    <div
        class="flex flex-col w-full bg-slate-50 rounded-lg shadow-xl justify-between h-full">
        <div class="flex gap-3 items-center justify-start min-h-fit h-fit px-3 py-1">
            <div class="w-12 h-auto fill-amber-200">
                 <x-logo-project/>
            </div>
            <span class="flex flex-col gap-1 text-gray-900 font-bold text-menu">
                <span class="capitalize">{{__(config('app.name'))}}</span>
            </span>
        </div>
        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent">
        <nav id="menuList" class="h-full overflow-y-scroll">
               @include('main::layouts.admin.partials.aside-nav')
        </nav>

        <div class="min-h-fit h-fit px-3 pt-1 pb-3">
            <hr class="h-px mt-0 mb-3 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent">
            <x-main::logout/>
        </div>
    </div>
</aside>
