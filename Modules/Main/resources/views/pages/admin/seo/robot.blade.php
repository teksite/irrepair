<x-main::admin-editor-layout :instance="$content" method="PATCH">
    @section('title' , __('edit :title',['title'=>__('robot.txt')]))
    @section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>'robot.txt','item'=>__('seo')]))
    @section('formRoute',route('admin.seo.robot.update'))
    @section('hero-start-section')
        <a href="/robots.txt" target="_blank" class="regular flex items-center gap-3 text-sm">
            <i class="tkicon" size="18" stroke-width="2" data-icon="link"></i>
            <span dir="ltr">
                {{url('/robots.txt')}}
            </span>
        </a>
    @endsection
    @section('main')
        <x-main::box>
            <x-main::input.label value="{{__('robot.txt')}}" for="robot" class="mb-3"/>
            <x-main::input.textarea id="robot" name="content" class="w-full block" rows="16" dir="ltr">
                {{$content}}
            </x-main::input.textarea>
        </x-main::box>
    @endsection

</x-main::admin-editor-layout>
