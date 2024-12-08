@props(['open'=>true])

<x-main::box>
    <div class="flex items-center gap-3">
        <x-main::input.label :value="__('has recaptcha')" class="!mb-0 min-w-fit w-fit" for="recaptcha"/>
        <x-main::input.checkbox id="recaptcha" value="1" name="recaptcha" :checked="isset($instance) && $instance->recaptcha"/>
    </div>
    <x-main::input.error :messages="$errors->get('recaptcha')" class="mt-2"/>

</x-main::box>
