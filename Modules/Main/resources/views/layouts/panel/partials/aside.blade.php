<aside x-data="{openSidebar:false}" :class="openSidebar ? 'translate-x-0 xl:mx-3' : 'translate-x-full'"
       x-on:open-aside.window="$event.detail == 'openSidebar' ? openSidebar = !openSidebar : false"  id="aside-admin-menu"
       class="fixed inset-y-0 start-0 block w-full px-3 py-3 overflow-hidden transition-all duration-200 ease-in-out border-0 xl:mx-3 z-10 max-w-64 rounded-2xl xl:translate-x-0" >
    <div class="flex flex-col gap-6 w-full justify-between h-full  backdrop-blur-lg bg-white/50 p-3 overflow-hidden rounded-2xl">
        <x-main::box class="min-h-fit h-fit mt-14">
            <figure class="flex flex-col gap-1 items-center justify-center -mt-12 mb-3">
                <img src="{{auth()->user()->featured_image}}" height="50" width="50" class="rounded-full border-2 border-slate-200 bg-white" alt="{{auth()->user()->name}}">
                <figcaption class="p text-center font-bold">
                    {{auth()->user()->name}}
                </figcaption>
            </figure>
            <div class="flex items-center justify-center gap-3">
                @can('client-edit')
                    <a href="{{route('panel.users.edit')}}">
                        <i class="tkicon icon fill-none stroke-current" data-icon="gears"></i>
                    </a>
                @endcan
                {!! Module::getMenu('panel','menu-profile-section') !!}

            </div>
        </x-main::box>
        <x-main::box class="h-full rounded-xl overflow-hidden !p-0">
            <nav id="menuList" class="h-full ">
                <ul class="ps-3 py-1 h-full overflow-y-scroll">
                    {!! Module::getMenu('panel','menu-before-profile') !!}
                    @can('client-edit')
                        <x-main::aside.link :title="__('profile')" icon="user" :href="route('panel.users.edit')" class="mt-6"/>
                    @endcan
                    {!! Module::getMenu('panel','menu-after-profile') !!}
                    @can('admin')
                        <x-main::aside.link :title="__('admin dashboard')" icon="gage" :href="route('admin.index')" class="mt-6"/>
                    @endcan
                </ul>
            </nav>
        </x-main::box>
        <x-main::box class="min-h-fit h-fit">
            <x-main::logout/>
        </x-main::box>
    </div>
</aside>
