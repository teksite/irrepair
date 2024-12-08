<ul class="py-1 px-1">
<x-main::aside.link :title="__('dashboard')" icon="home" :href="route('admin.index')" class="mt-3  mb-3" :active="request()->routeIs('admin.index')"/>
{!! Module::getMenu('admin','menu-after-dashboard') !!}

{!! Module::getMenu('admin','menu-before-setting') !!}
@can('setting-edit')
    <x-main::accordion.nav :title="__('settings')" icon="gears" class="mt-12 mb-3" :active="request()->routeIs(['admin.settings.*'])">
        <x-main::accordion.link href="{{route('admin.settings.info')}}" :title="__('all :title',['title'=>__('information')])" :active="request()->routeIs('admin.settings.info')">
            {{__(':title list',['title'=>__('information')])}}
        </x-main::accordion.link>

        <x-main::accordion.link href="{{route('admin.settings.caches.index')}}" :title="__('all :title',['title'=>__('caches')])" :active="request()->routeIs('admin.settings.caches.index')">
            {{__(':title list',['title'=>__('caches')])}}
        </x-main::accordion.link>
        <x-main::accordion.link href="{{route('admin.settings.logs.index')}}?log=laravel" :title="__('all :title',['title'=>__('logs')])" :active="request()->routeIs('admin.settings.logs.index')">
            {{__(':title list',['title'=>__('logs')])}}
        </x-main::accordion.link>
        <x-main::accordion.link href="{{route('admin.settings.batchjobs.index')}}" :title="__('all :title',['title'=>__('jobs')])" :active="request()->routeIs('admin.settings.batchjobs.index')">
            {{__(':title list',['title'=>__('batch jobs')])}}
        </x-main::accordion.link>

        {!! Module::getMenu('admin','menu-setting') !!}
    </x-main::accordion.nav>
@endcan
    {!! Module::getMenu('admin','menu-after-setting') !!}

    {!! Module::getMenu('admin','menu-before-appearance') !!}
    <x-main::accordion.nav class="mt-12  mb-3" :title="__('appearance')" icon="columns-three" :active="request()->routeIs('admin.appearance.*') || \Illuminate\Support\Str::contains(url()->current() , 'appearance')">
        <x-main::accordion.link href="{{route('admin.appearance.icons.index')}}" :title="__('all :title',['title'=>__('icons')])" :active="request()->routeIs('admin.appearance.icons.index')">
            {{__(':title list',['title'=>__('icons')])}}
        </x-main::accordion.link>

        <x-main::accordion.link href="{{route('admin.appearance.file-manager.index')}}" :title="__('file manager')" :active="request()->routeIs('admin.appearance.file-manager.index')">
            {{__('file manager')}}
        </x-main::accordion.link>

        {!! Module::getMenu('admin','menu-appearance') !!}
    </x-main::accordion.nav>
    {!! Module::getMenu('admin','menu-after-appearance') !!}

    {!! Module::getMenu('admin','menu-before-user') !!}
@can('user-read')
    <x-main::accordion.nav :title="__('users')" icon="users" class="mt-12 mb-3" :active="request()->routeIs(['admin.users.*'])">
        <x-main::accordion.link href="{{route('admin.users.index')}}" :title="__('all :title',['title'=>__('users')])" :active="request()->routeIs('admin.users.index')">
            {{__(':title list',['title'=>__('users')])}}
        </x-main::accordion.link>
        @can('user-create')

            <x-main::accordion.link href="{{route('admin.users.create')}}" :title="__('new :title',['title'=>__('user')])" :active="request()->routeIs('admin.roles.create')">
                {{__('create a new :item',['item'=>__('user')])}}
            </x-main::accordion.link>
        @endcan
    </x-main::accordion.nav>
@endcan
    {!! Module::getMenu('admin','menu-after-user') !!}

    {!! Module::getMenu('admin','menu-before-authorize') !!}
@canany(['role-read','permission-read'])
    <x-main::accordion.nav :title="__('authorizations')" icon="lock-closed" class="mt-3 mb-3" :active="request()->routeIs(['admin.roles.*','admin.permissions.*'])">
        @can('role-read')
            <x-main::accordion.link href="{{route('admin.roles.index')}}" :title="__('all :title',['title'=>__('roles')])"
                                    :active="request()->routeIs('admin.roles.*')">
                {{__(':title list',['title'=>__('roles')])}}
            </x-main::accordion.link>
        @endcan
        @can('permission-read')
            <x-main::accordion.link href="{{route('admin.permissions.index')}}" :title="__('all :title',['title'=>__('permissions')])" :active="request()->routeIs('admin.permissions.*')">
                {{__(':title list',['title'=>__('permissions')])}}
            </x-main::accordion.link>
        @endcan
    </x-main::accordion.nav>
@endcanany
    {!! Module::getMenu('admin','menu-after-authorize') !!}

    {!! Module::getMenu('admin','menu-before-tag') !!}
@can('admin')
    <x-main::aside.link :title="__('tags')" icon="tag" :href="route('admin.tags.index')" class="mt-12 mb-3"/>
@endcan
    {!! Module::getMenu('admin','menu-after-tag') !!}

    {!! Module::getMenu('admin','menu-before-seo') !!}
    @can('seo-edit')
        <x-main::accordion.nav :title="__('seo')" icon="magnifier" class="mt-12" :active="request()->routeIs('admin.seo.*')">

            <x-main::accordion.link href="{{route('admin.seo.robot.edit')}}" :title="__('robot txt')" :active="request()->routeIs('admin.seo.robot.*')">
                {{__('Robot.txt')}}
            </x-main::accordion.link>

            <x-main::accordion.link href="{{route('admin.seo.sitemap.index')}}" :title="__('sitemap')"
                                    :active="request()->routeIs('admin.seo.sitemap.*')">
                {{__('sitemap')}}
            </x-main::accordion.link>

            <x-main::accordion.link href="{{route('admin.seo.general.edit')}}?type=seo_general"
                                    :title="__('general')"
                                    :active="request()->routeIs('admin.seo.general.*')">
                {{__('general seo')}}
            </x-main::accordion.link>

            <x-main::accordion.link href="{{route('admin.seo.others.index')}}"
                                    :title="__('other')"
                                    :active="request()->routeIs('admin.seo.others.*')">
                {{__('other')}}
            </x-main::accordion.link>

            {!! \Nwidart\Modules\Facades\Module::getMenu('admin','menu-seo') !!}
        </x-main::accordion.nav>
    @endcan
    {!! Module::getMenu('admin','menu-after-seo') !!}

</ul>
