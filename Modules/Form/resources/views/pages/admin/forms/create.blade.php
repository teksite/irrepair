<x-main::admin-editor-layout>
    @section('title' , __('new :title',['title'=>__('form')]))
    @section('formRoute',route('admin.forms.store'))
    @section('header-description' , __("in this window you create a new :title" , ["title"=>__('form')]))
    @section('hero-start-section')
        <x-main::link.header :title="__('all :title',['title' =>__('forms')])" :href="route('admin.forms.index')"/>
    @endsection
    @section('hero-end-section')
    @endsection
    @section('main')
        <section class="xl:w-2/3">
            <table class="w-full">
                <tr>
                    <th>
                        <x-main::input.label for="title" value="{{__('title')}}" class="!mb-0"/>
                    </th>
                    <td>
                        <x-main::input.text id="title" class="block mt-1 w-full bg" type="text" name="title" :value="old('title')" />
                        <x-main::input.error :messages="$errors->get('title')" class="mt-2"/>

                    </td>
                </tr>
                <tr>
                    <th>
                        <x-main::input.label for="emails" value="{{__('emails')}}" class="!mb-0"/>
                    </th>
                    <td>
                        <x-main::input.text id="emails" class="block mt-1 w-full bg" type="text" name="emails" :value="old('emails')" dir="ltr"/>
                        <x-main::input.error :messages="$errors->get('emails')" class="mt-2"/>

                    </td>
                </tr>
                <tr>
                    <th>
                        <x-main::input.label for="phones" value="{{__('phones')}}" class="!mb-0"/>
                    </th>
                    <td>
                        <x-main::input.text id="phones" class="block mt-1 w-full bg" type="text" name="phones" :value="old('phones')" dir="ltr"/>
                        <x-main::input.error :messages="$errors->get('phones')" class="mt-2"/>

                    </td>
                </tr>
                <tr>
                    <th>
                        <x-main::input.label for="urls" value="{{__('urls')}}" class="!mb-0"/>
                    </th>
                    <td>
                        <x-main::input.text id="urls" class="block mt-1 w-full bg" type="text" name="urls" :value="old('urls')" dir="ltr"/>
                        <x-main::input.error :messages="$errors->get('urls')" class="mt-2"/>

                    </td>
                </tr>
                <tr>
                    <th>
                        <x-main::input.label for="telegram_id" value="{{__('telegram ids')}}" class="!mb-0"/>
                    </th>
                    <td>
                        <x-main::input.text id="telegram_id" class="block mt-1 w-full bg" type="text" name="telegram_id" :value="old('telegram_id')" dir="ltr"/>
                        <x-main::input.error :messages="$errors->get('telegram_id')" class="mt-2"/>

                    </td>
                </tr>
            </table>

        </section>
        <x-main::box class="mb-3">
            <x-main::input.label for="body" value="{{__('body')}}"/>
            <x-main::input.textarea id="body" class="block mt-1 w-full" rows="15" name="body" dir="ltr">{{old('body')}}</x-main::input.textarea>
            <x-main::input.error :messages="$errors->get('body')" class="mt-2"/>
        </x-main::box>
        <x-main::box class="mb-3">
            @include('form::layouts.admin.sections.rules',['open'=>'true'])
        </x-main::box>

    @endsection
    @section('aside')
        @include('form::layouts.admin.sections.active')
        @include('form::layouts.admin.sections.recaptcha')
        @include('main::layouts.admin.sections.template',['open'=>'true','path'=>'resources/views/forms'])

    @endsection

</x-main::admin-editor-layout>
