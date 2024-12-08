@props(['open'=>true])

<x-main::box>
    <div class="flex items-center gap-3">
        <x-main::input.label :value="__('has file')" class="!mb-0 min-w-fit w-fit" for="active"/>
        <x-main::input.checkbox id="active" value="1" name="has_file" :checked="isset($instance) && $instance->has_file"/>
    </div>
    <x-main::input.error :messages="$errors->get('has_file')" class="mt-2"/>

    </x-main::box>
