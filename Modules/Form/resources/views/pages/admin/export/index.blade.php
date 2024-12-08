<x-main::admin-layout xmlns:x-main="http://www.w3.org/1999/html">
    @section('title' , __('inbox'))
    @section('header-description' , __("in this window you can export :title",['title'=>__('inbox')]))

    @section('hero-start')

    @endsection

    @section('hero-end')
    @endsection

    <x-main::box>
        <form action="{{route('admin.forms.inboxes.export.execute')}}">
            <div class="grid md:grid-cols-2 gap-6 items-end">
                <div>
                    <x-main::input.label for="form_title" :value="__('form')"/>
                    <x-main::input.select name="form" id="form_title" class="block w-full">
                        @foreach($forms as $form)
                            <option value="{{$form->id}}">{{$form->title}}</option>
                        @endforeach
                    </x-main::input.select>
                    <x-main::input.error :messages="$errors->get('form')" class="mt-2"/>
                </div>
                <div class="flex items-center gap-3">
                    <x-main::input.label :value="__('date')"/>
                    <div class="flex items-center gap-1">
                        <x-main::input.label for="date_start" :value="__('from')"/>
                        <x-main::input.date name="date[start]" id="date_start" type="date"/>
                    </div>
                    <div class="flex items-center gap-1">
                        <x-main::input.label for="date_end" :value="__('until')"/>
                        <x-main::input.date name="date[end]" id="date_end" type="date"/>
                    </div>

                    <x-main::input.error :messages="$errors->get('form')" class="mt-2"/>
                </div>

            </div>
            <div class="flex items-center justify-end self-end">
                <x-main::button.primary type="submit" role="button">{{__('export')}}</x-main::button.primary>
            </div>

        </form>

    </x-main::box>
</x-main::admin-layout>
