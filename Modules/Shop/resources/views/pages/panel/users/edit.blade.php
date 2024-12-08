<x-main::panel-editor-layout>
    @section('title',__('profile'))
    @section('hero-start')
        <h2>
            {{__('profile')}}
        </h2>
    @endsection
    @section('hero-end')
        @include('main::layouts.panel.partials.user-menu')
    @endsection

    @section('main')
        <form method="POST" action="{{route('panel.users.update')}}" enctype="multipart/form-data">
            @csrf  @method('PATCH')
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <x-main::box class="lg:col-span-2">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg">{{__('profile information')}}</h2>
                        <div class="flex justify-end items-center gap-3">
                             <span class="text-xs cursor-default p mb-0">
                                   {{__('roles')}}:
                            </span>
                            <span class="text-xs cursor-default	p mb-0" title="{{__('roles')}}">
                                {{$user->roles->pluck('title')->implode(',')}}
                            </span>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="my-3">
                        <x-main::input.label for="name" value="{{__('name')}}/{{__('company')}}"/>
                        <x-main::input.text class="block mt-1 w-full" id="name" type="text" name="name" :value="old('name') ?? $user->name"/>
                        <x-main::input.error :messages="$errors->get('name')" class="mt-2"/>
                    </div>
                    <div class="my-3">
                        <x-main::input.label for="phone" value="{{__('phone number')}}"/>
                        <x-main::input.text class="block mt-1 w-full bg-gray-50" id="phone" type="tel" :disabled="true" :value="$user->phone"/>

                    </div>

                    <div class="my-3">
                        <x-main::input.label for="username" value="{{__('username')}}"/>
                        <x-main::input.text class="block mt-1 w-full bg-gray-50" id="username" :disabled="true" type="text" :value="$user->username"/>
                    </div>

                    <div class="my-3">
                        <x-main::input.label for="email" value="{{__('email')}}"/>
                        <x-main::input.text class="block mt-1 w-full bg-gray-50" id="email" type="email" :disabled="true" :value="$user->email"/>
                    </div>

                </x-main::box>
                <x-main::box class="flex flex-col items-center">
                    <img src="{{asset($user->featured_image ??'/admin/images/no-profile.jpg')}}" alt="{{$user->name}}"
                         title="{{$user->name}}" width="290" height="290" id="profileAvatarPreview"
                         class="border border-slate-200 rounded-lg p-1 mx-auto">
                    <input type="file" id="uploadFileBtn" name="featured_image" value="{{$user->featured_image ??'/admin/images/no-profile.jpg' }}">
                    <x-main::input.error :messages="$errors->get('featured_image')" class="mt-2"/>
                </x-main::box>
            </div>
            <x-main::box class="md:col-span-2 xl:col-span-3">
                @include('main::layouts.admin.sections.user_extra_info' ,['instance'=>$user->getMeta('social')])
            </x-main::box>

            @if($user->slug || Route::has('users.show'))
                <x-main::box class="mb-6 flex gap-3 justify-between items-center">
                 <div class="">
                        @if($user->slug)

                        <div class="flex items-center gap-6 mb-3 ">
                            <x-main::input.label class="!mb-0" :value="__('your id')"/>
                            <span class="p">{{$user->slug}}</span>
                        </div>
                        @endif
                        @if(Route::has('users.show'))
                        <div class="flex items-center gap-6">
                            <a href="{{route('users.show',$user)}}" target="_blank"
                               class="flex items-center gap-6 regular">
                                {{__('your page')}}:
                                <i class="tkicon icon" size="16" data-icon="eye"></i>
                            </a>
                        </div>
                        @endif
                    </div>
            </x-main::box>
            @endif
            <input type="hidden" class="hidden" id="userIdentifier" name="identifier" value="{{\Illuminate\Support\Facades\Crypt::encrypt($user->id)}}">

            <div class="mt-12 flex items-center justify-end">
                <x-main::button.primary role="button" type="submit">
                    {{__('update')}}
                </x-main::button.primary>
            </div>
        </form>
    @endsection

</x-main::panel-editor-layout>
