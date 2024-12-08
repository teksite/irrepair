@can('menu-read')
    <x-main::accordion.link href="{{route('admin.appearance.menus.index')}}" :title="__('all :title',['title'=>__('menus')])"
                            :active="request()->routeIs('admin.appearance.menus.index')">
        {{__(':title list',['title'=>__('menus')])}}
    </x-main::accordion.link>
@endcan
