<div>
    @auth()
        <div class="sm:flex sm:items-center sm:mx-3 w-full">
            <x-dropdown align="left" width="min-w-fit" contentClasses="bg-white w-56">
                <x-slot name="trigger">
                    <button title="{{__('profile')}}" type="button" role="button"
                            class="inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <img src="{{auth()->user()->featured_image}}" alt="" width="40" height="40" class="rounded-full border border-slate-200">

                    </button>
                </x-slot>

                <x-slot name="content">

                    <div class="relative p">
                        <span class="font-bold block" id="profile-button-name">{{ auth()->user()->name }}</span>
                        <span class="text-sm block" id="profile-button-username">{{ auth()->user()->username }}</span>
                        <span class="absolute inset-y-0 border-l-2 border-dotted border-slate-400 -start-1.5"></span>
                    </div>
                    <hr class="my-1">
                    <ul class="space-y-1">
                        @can('client-panel')
                            @if(Route::has('panel.announcements.index'))
                            <li class="hover:bg-gray-50">
                                <a href="{{route('panel.announcements.index')}}"
                                   class="inline-flex gap-1 items-center p text-sm">
                                    <i class="tkicon fill-none stroke-current" size="16" data-icon="bell-ring"></i>
                                    {{__('announcements')}}
                                    <span class="bg-red-600 text-gray-50 leading-none w-4 h-4 flex items-center justify-center rounded-full">
                                        {{auth()->user()->announcements()->whereNull('read_at')->count()}}
                                    </span>
                                </a>
                            </li>
                            @endif
                            <li class="hover:bg-gray-50">
                                <a href="{{route('panel.index')}}"
                                   class="inline-flex gap-1 items-center text-gray-700 text-sm">
                                    <i class="tkicon fill-none stroke-gray-700 "datra-icon="user" size="16"></i>
                                    {{__("user's panel")}}
                                </a>
                            </li>
                            @if(Module::isAvailable('Academy') && Route::has('courses.index'))
                            <li>
                                <a href="{{route('courses.index')}}"
                                   class="inline-flex gap-1 items-center text-gray-700 text-sm">
                                    <i class="tkicon fill-none stroke-gray-700" data-icon="education"
                                       size="16"></i>
                                    {{__('available courses')}}
                                </a>
                            </li>
                            @endif
                        @endcan
                        @if(Route::has('users.show'))
                            <li class="hover:bg-gray-50">
                                <a href="{{route('users.show', auth()->user())}}"
                                   class="inline-flex gap-1 items-center text-gray-700 text-sm">
                                    <i class="tkicon fill-none stroke-gray-700" size="16" data-icon="eye"></i>
                                    {{__('your page')}}
                                </a>
                            </li>
                        @endif
                        <li>
                            <hr class="my-1">
                            <div class="flex justify-end">
                                <x-logout/>
                            </div>
                        </li>
                    </ul>
                </x-slot>
            </x-dropdown>
        </div>
    @else
        <a href="{{route('login')}}"
           class="text-gray-700 py-3 px-6 flex items-center gap-1 min-w-max shadow rounded-lg">
            <span class="font-bold text-sm">{{__('login')}}</span>
        </a>
    @endauth
</div>
