@can('setting-edit')
    <x-main::accordion.link href="{{route('admin.settings.captcha.edit')}}" :title="__('captcha')"
                            :active="request()->routeIs('admin.settings.captcha.edit')">
        {{__('captcha')}}
    </x-main::accordion.link>
@endcan
