<div class="mb-6">
    <div class="mb-3">
        <div class="md:flex gap-3 items-center ">
            <x-main::input.label for="slug" value="{{__('slug')}}"/>
            <x-main::input.text id="slug" class="block  w-full bg" type="text" name="slug" placeholder="{{__('write an unique :title',['title'=>__('slug')])}}"
                                :value="old('slug') ?? $instance->slug ?? ''" dir="ltr"/>
        </div>
        <x-main::input.error :messages="$errors->get('slug')" class="mt-2"/>
    </div>
    @if(isset($instance) && method_exists($instance,'path'))
        @include('main::layouts.admin.sections.slug-link',['instance'=>$instance])
    @endif
</div>
