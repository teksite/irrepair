<div class="flex gap-1 items-center justify-end ">
    @can('client-edit')
        <x-main::link.nav icon="user" :href="route('panel.users.edit')" :title="__('profile')" />
        <x-main::link.nav icon="monitor" :href="route('panel.users.sessions.index')" :title="__('sessions')" />
    @endcan
    @can('client-password-edit')
        <x-main::link.nav icon="password" :href="route('panel.users.password.edit')" :title="__('password')" />
    @endcan
    @can('client-two-factor-auth')
            <x-main::link.nav icon="key" :href="route('panel.users.twofactorauth')" :title="__('two factor')" />
    @endcan


</div>
