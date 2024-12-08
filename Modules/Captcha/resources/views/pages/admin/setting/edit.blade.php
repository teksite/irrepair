<x-main::admin-list-layout>
    @section('title' , __(':title list',['title'=>__('captcha')]))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('captcha')]))

    @section('hero-start-section')

    @endsection
    @section('hero-end-section')
    @endsection

    @section('main')
        <main::x-box>
            <div x-data="{ tabs: [{ id: 1, title: 'local', active: true },{ id: 2, title: 'google', active: false }], activeTab: 1 }">
                <!-- Tabs -->
                <nav class="relative flex w-full overflow-hidden z-0 rounded-t-lg shadow" aria-label="Tabs">
                    <template x-for="(tab, ix) in tabs" :key="tab.id">
                        <a href="#" :class="tab.active ? 'bg-white' : 'bg-gray-100'"
                           class="group relative min-w-0 flex-1 overflow-hidden py-4 px-4 text-center hover:bg-gray-50 focus:z-10" :aria-current="tab.active ? 'page' : 'undefined'"
                           @click.prevent="tabs.forEach(tab => tab.active = false); tabs[ix].active = true">
                            <span x-text="tab.title" class="tab.active ? 'text-black' : 'text-gray-800'"></span>
                            <span aria-hidden="true" :class="tab.active ? 'bg-blue-600' : 'bg-transparent'" class="absolute inset-x-0 bottom-0 h-1"></span>
                        </a>
                    </template>
                </nav>

                <div class="shadow">
                    <x-main::box>
                        <section x-show="tabs.find(tab => tab.id === 1).active">
                            @include('captcha::layouts.admin.sections.captcha.local')
                        </section>
                        <section x-show="tabs.find(tab => tab.id === 2).active">
                            @include('captcha::layouts.admin.sections.captcha.google_v2')
                        </section>
                    </x-main::box>
                </div>
            </div>
        </main::x-box>
    @endsection

</x-main::admin-list-layout>

