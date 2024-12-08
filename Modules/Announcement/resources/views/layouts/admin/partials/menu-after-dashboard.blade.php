@can('announcement-read')
    <x-main::accordion.nav :title="__('announcements')" icon="megaphone" :active="request()->routeIs('admin.announcements.*')">

        <x-main::accordion.link href="{{route('admin.announcements.index')}}" :title="__('all :title',['title'=>__('announcements')])"
                                :active="request()->routeIs('admin.announcements.index')">
            {{__(':title list' ,['title'=>__('announcements')])}}
        </x-main::accordion.link>

        @can('announcement-create')
        <x-main::accordion.link href="{{route('admin.announcements.create')}}" :title="__('new :title' ,['title'=>__('announcements')])"
                                :active="request()->routeIs('admin.announcements.create')">
            {{__('new :title',['title'=>__('announcement')])}}
        </x-main::accordion.link>
        @endcan

    </x-main::accordion.nav>
@endcan
