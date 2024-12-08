<x-main::accordion.single :title="__('seo')">

    <div x-data="{ tabs: [
        { id: 1, title: 'meta tags', active: true },
        { id: 2, title: 'schema', active: false },
        { id: 3, title: 'sitemap', active: false },
      ], activeTab: 1 }">
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
                    @if(isset($instance ,$instance->seo))
                        @include('main::layouts.admin.sections.seo.meta',['instance'=>$instance])
                    @else
                        @include('main::layouts.admin.sections.seo.meta')
                    @endif
                </section>
                <section x-show="tabs.find(tab => tab.id === 2).active">
                    @if(isset($instance ,$instance->seo))
                        @include('main::layouts.admin.sections.seo.schema',['instance'=>$instance])
                    @else
                        @include('main::layouts.admin.sections.seo.schema')
                    @endif
                </section>
                <section x-show="tabs.find(tab => tab.id === 3).active">
                    @if(isset($instance ,$instance->seo))
                        @include('main::layouts.admin.sections.seo.sitemap',['instance'=>$instance])
                    @else
                        @include('main::layouts.admin.sections.seo.sitemap')
                    @endif
                </section>
            </x-main::box>
        </div>
    </div>

</x-main::accordion.single>
