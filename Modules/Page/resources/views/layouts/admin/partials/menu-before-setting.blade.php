@can('page-read')
    <x-main::accordion.nav :title="__('pages')" icon="paper-blank" class="" :active="request()->routeIs('admin.pages.*')">

        <x-main::accordion.link href="{{route('admin.pages.index')}}" :title="__('all :title',['title'=>__('pages')])" :active="request()->routeIs('admin.pages.index')">
            {{__(':title list',['title'=>__('page')])}}
        </x-main::accordion.link>
        @can('page-create')
            <x-main::accordion.link href="{{route('admin.pages.create')}}" :title="__('new :title',['title'=>__('page')])"
                                    :active="request()->routeIs('admin.pages.edit')">
                {{__('new :title',['title'=>__('page')])}}
            </x-main::accordion.link>
        @endcan
    </x-main::accordion.nav>
@endcan
