@php use Modules\Main\Models\Setting; @endphp
<x-main::admin-editor-layout method="PATCH">
    @section('title' , __('edit :title',['title'=>__('site settings')]))
    @section('header-description' , __("in this window you can edit the :title", ['title'=>__('site settings')]))
    @section('formRoute',route('admin.settings.update'))
    @section('hero-start-section')
    @endsection
    @section('main')
        <x-main::box>
            <x-main::input.label for="kaveh_negar" title="kaveh negar"
                                 value="Kaveh Negar: API_KEY"/>
            <x-main::input.text type="text" id="kaveh_negar" dir="ltr"
                                :value="old('kaveh_negar_api_key') ?? Setting::where('key','kaveh_negar_api_key')->first()?->value ?? env('KAVEHNEGAR_API_KEY')"
                                name="kaveh_negar_api_key"
                                class="block w-full"
                                placeholder="{{__('enter your username or phone')}}"/>
            <x-main::input.error :messages="$errors->get('kaveh_negar_api_key')" class="mt-2"/>

        </x-main::box>
    @endsection

</x-main::admin-editor-layout>
