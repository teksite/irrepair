<div x-data="{ selectedOption: '' }">
    <!-- Select Box -->
 <div class="flex items-center justify-start gap-1">
     <x-main::input.label for="ways" :value="__('target')" class="!mb-0 min-w-fit w-fit"/>
     <x-main::input.select x-model="selectedOption" class="form-select block w-full" name="target">
         <option value="" disabled>{{__('choose')}}</option>
         <option value="users">{{__('users')}}</option>
         <option value="roles">{{__('roles')}}</option>
         <option value="newsletter">{{__('newsletter')}}</option>
     </x-main::input.select>
     <x-main::input.error :messages="$errors->get('target')" class="mt-2"/>

 </div>

    <div x-show="selectedOption === 'users'" id="users" class="mt-4">
        @include('main::layouts.admin.sections.get-users',['open'=>"true" ,'multiple'=>"true",'name'=>'users[]','label'=>__('users'), 'selected'=>[]])
    </div>

    <div x-show="selectedOption === 'roles'" id="roles" class="mt-4">
        @include('main::layouts.admin.sections.get-models',['open'=>"true" ,'multiple'=>false,'label'=>__('roles') ,'dataLabel'=>'title' ,'dataValue'=>'id' ,'dataSearch'=>'title' ,'name'=>'roles[]' ,'url'=>route('admin.ajax.roles.get') ])
    </div>

    <div x-show="selectedOption === 'newsletter'" id="newsletter" class="mt-4">
        <!-- Content for Newsletter -->
        <p>{{__('sending the email to all active mail in the newsletter')}}</p>
    </div>

    <x-main::box x-show="selectedOption === 'users' || selectedOption === 'roles'" class="mt-4">
        <div class="flex items-center gap-3">
            <x-main::input.label class="!mb-0" for="pinned" :value="__('ways')"/>
            <x-main::input.select :multiple="true" name="routes[]" id="routes" class="block w-full">
                <option value="site" selected >{{__('site')}}</option>
                <option value="email" selected>{{__('email')}}</option>
                <option value="sms">{{__('sms')}}</option>
                <option value="telegram">{{__('telegram')}}</option>
            </x-main::input.select>
        </div>

        <x-main::input.error :messages="$errors->get('routes')" class="mt-2"/>
        <x-main::input.error :messages="$errors->get('routes.*')" class="mt-2"/>
    </x-main::box>

</div>
