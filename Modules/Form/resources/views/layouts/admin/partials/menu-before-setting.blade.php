@canany(['form-read', 'form-receive-read'])
    <x-main::accordion.nav :title="__('forms')" icon="paper-board" class="" :active="request()->routeIs('admin.forms.*')">

        @can('form-read')
        <x-main::accordion.link href="{{route('admin.forms.index')}}" :title="__('all :title',['title'=>__('forms')])" :active="request()->routeIs('admin.forms.index')">
            {{__(':title list',['title'=>__('forms')])}}
        </x-main::accordion.link>
        @endcan

        @can('form-create')
            <x-main::accordion.link href="{{route('admin.forms.create')}}" :title="__('new :title',['title'=>__('form')])"
                                    :active="request()->routeIs('admin.forms.edit')">
                {{__('new :title',['title'=>__('form')])}}
            </x-main::accordion.link>
        @endcan
        @can('form-receive-read')
            <x-main::accordion.link href="{{route('admin.forms.inboxes.index')}}" :title="__('all :title',['title'=>__('inboxes')])" :active="request()->routeIs(['admin.forms.inboxes.index' , 'admin.forms.inbox.index'])">
                {{__(':title list',['title'=>__('inboxes')])}}
            </x-main::accordion.link>

            <x-main::accordion.link href="{{route('admin.forms.analytics.show')}}" :title="__('analytics')" :active="request()->routeIs('admin.forms.analytics.show')">
                {{__('analytics')}}
            </x-main::accordion.link>
        @endcan
        @can('form-receive-export')
                <x-main::accordion.link href="{{route('admin.forms.inboxes.export.index')}}" :title="__('export')" :active="request()->routeIs('admin.forms.inboxes.export.index')">
                    {{__('export')}}
                </x-main::accordion.link>
        @endcan
    </x-main::accordion.nav>
@endcanany
