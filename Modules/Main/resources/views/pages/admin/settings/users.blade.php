<x-admin-editor-layout  method="PATCH">
    @section('title' , __('edit :title',['title'=>__('users settings')]))
    @section('header-description' , __("in this window you can edit the :title", ['title'=>__('users settings')]))

    @section('formRoute',route('admin.settings.users.update'))

    @section('hero-start-section')
        <a href="{{route('admin.users.index')}}" class="regular">
            {{__('all')}}
        </a>
    @endsection

    @section('main')
        <x-main::box>
        <x-main::input.label :value="__('notification to')" for="users" />
             <x-main::input.select :multiple="true" name="users[]" id="users">
                 @foreach($allUsers as $user)
                     <option value="{{$user->id}}" {{in_array($user->id , $relatedUsers) ? 'selected' : ''}} >
                         {{$user->name}}
                     </option>
                 @endforeach
             </x-main::input.select>


            <x-main::input.error :messages="$errors->get('users')" class="mt-2"/>

        </x-main::box>

    @endsection

</x-admin-editor-layout>
