@can('theme-edit')
    <x-main::accordion.link href="{{route('admin.appearance.theme.edit')}}" :title="__('edit :title',['title'=>__('homepage')])"
                            :active="request()->routeIs('admin.appearance.theme.edit')">
        {{__('edit :title',['title'=>__('homepage')])}}
    </x-main::accordion.link>
@endcan
