@can('setting-edit')
    <x-main::accordion.link href="{{route('admin.restrictIPs.index')}}" :title="__('restrict ip list')"
                            :active="request()->routeIs('admin.restrictIPs.index')">
        {{__('restricting ip')}}
    </x-main::accordion.link>
@endcan
