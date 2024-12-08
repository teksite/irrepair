@can('widget-read')
    <x-main::accordion.link href="{{route('admin.widgets.index')}}" :title="__('all :title',['title'=>__('widgets')])"
                            :active="request()->routeIs('admin.widgets.*')">
        {{__(':title list',['title'=>__('widgets')])}}
    </x-main::accordion.link>
@endcan
