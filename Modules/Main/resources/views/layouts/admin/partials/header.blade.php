<header class="p-3 mb-6">
    <div class="mb-6 flex justify-between items-center">
        <div class="flex gap-1 items-center p text-xs font-bold bg-gray-200 rounded-2xl px-3 py-2 min-w-fit">
            <i class="tkicon stroke-gray-600 fill-none" height="18" width="" data-icon="home"></i>
            <span>{{__('admin dashboard')}}</span>
        </div>
        <hr class="border-gray-200 w-full">
        <div class="flex items-center justify-end gap-3 bg-gray-200 rounded-2xl px-3 py-2 min-w-fit">
            <a href="/" class="p" title="{{__('visit :title',['title'=>__('website')])}}">
                <i class="tkicon stroke-current" data-icon="world"></i>
            </a>

            @auth()
                <a href="{{route('panel.index')}}" class="text-sky-600" title="{{__('user panel')}}">
                    <i class="tkicon stroke-current" data-icon="user"></i>
                </a>
            @endauth
            <button  @click="togglesSidebar()" type="button" role="button">
                <i class="tkicon stroke-blue-600 block border border-blue-600 rounded-lg p-1" stroke-width="2px" data-icon="bar-3"></i>
            </button>
        </div>
    </div>
    <div class="w-full min-h-64 bg-admin-1 bg-cover bg-center bg-no-repeat overflow-hidden rounded-xl flex items-center">
        <div class="w-full min-h-64 h-full bg-blue-950/20 p-6 flex flex-col justify-center">
            <h1 class="text-white mb-6">
                @yield('title')
            </h1>
            <div class="text-sm font-bold text-white">
                @yield('header-description')
            </div>
        </div>
    </div>
    @if(View::hasSection('hero-start') || View::hasSection('hero-end'))
        <div
            class="w-11/12 mx-auto bg-white/50 backdrop-blur-2xl px-6 h-20 -mt-10 rounded-xl flex justify-between p-1 items-center">
            <div class="flex items-center justify-start gap-3 ">
                @yield('hero-start')
            </div>
            <div class="flex items-center justify-end gap-3">
                @yield('hero-end')
            </div>
        </div>
    @endif

</header>
