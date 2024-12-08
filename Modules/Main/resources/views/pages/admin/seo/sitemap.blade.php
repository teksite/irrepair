<x-main::admin-editor-layout method="PATCH">
@section('title' , __('edit :title',['title'=>__('sitemap')]))
    @section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('sitemap'),'item'=>__('seo')]))
    @section('formRoute',route('admin.seo.sitemap.generate'))
    @section('hero-start-section')
        @if(File::exists(public_path('/sitemaps/sitemap.xml')))
            <a href="/sitemaps/sitemap.xml" target="_blank" class="regular flex items-center gap-1 text-sm">
                <i class="tkicon stroke-current fill-none" size="18" data-icon="link" stroke-width="2"></i>
                <span dir="ltr">
                {{url('/sitemaps/sitemap.xml')}}
            </span>
            </a>
        @endif
    @endsection
    @section('main')
        <x-main::box>
            <p>
                {{__('to generate sitemap click on "update" button')}}.
            </p>
            <p>
                {{__('if some links are missed in the sitemap, call your site admin to fix it')}}.
            </p>
        </x-main::box>
    @endsection
    @section('aside')
        <x-main::box>
           <div class="flex items-center justify-start gap-1">
               <span class="group group relative">
                   <span class="hidden shadow group-hover:block absolute rounded-2xl bg-white w-96 p-3 start-0 end-auto lg:start-auto lg:end-0  text-sm p">
                       "auto":{{__('a robot automatic crawls entire website and detect all url')}}
                       <br>
                       "single":{{__("manual way - one file is created for all urls")}}
                       <br>
                       "index":{{__("manual way - one file in created as main sitemap and created multiple file for each module or category")}}
                   </span>
                   <i class="p-1 w-6 h-6 border border-blue-600 tkicon fill-none stroke-current regular-link rounded-full  " data-icon="exclamation"></i>
               </span>
               <p>{{__('the type of sitemap generation')}}:
                   <span class="font-bold">{{config('sitesetting.sitemap')}}</span>
               </p>
           </div>
        </x-main::box>
    @endsection

</x-main::admin-editor-layout>
