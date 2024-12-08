@can('setting-edit')
    <x-main::accordion.link href="{{route('admin.settings.sso.edit')}}?type=google" :title="__('sso')"
                            :active="request()->routeIs('admin.settings.sso.edit')">
        {{__('sso')}}
    </x-main::accordion.link>
@endcan
