<div class="mb-3">
    <div class="md:flex gap-3 items-center">
        <x-main::input.label for="title" :value="__('title')" class="!mb-0"/>
        <x-main::input.text id="title" class="block w-full" type="text" name="title" placeholder="{{__('write a :title',['title'=>__('title')])}}" :value="old('title') ?? $instance?->title ?? ''"/>
    </div>
    <x-main::input.error :messages="$errors->get('title')" class="mt-2"/>
</div>
