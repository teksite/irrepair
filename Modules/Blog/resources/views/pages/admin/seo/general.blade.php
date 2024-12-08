<x-main::admin-editor-layout  method="PATCH">
    @section('title' , __('edit seo of :title page',['title'=>__('blog')]))
    @section('header-description',__('in this window you can see change details of seo'))
    @section('formRoute',route('admin.seo.others.blog.update'))

    @section('main')
        <x-main::box class="">
            <fieldset class="fieldset" >
                <legend>
                    <h3>{{__('blog')}}</h3>
                </legend>
                <input type="hidden" class="hidden" name="key" value="blog_index">
               @include('main::layouts.admin.sections.seo.types.blog',['schema'=>$schema])
            </fieldset>
        </x-main::box>


    @endsection

</x-main::admin-editor-layout>
