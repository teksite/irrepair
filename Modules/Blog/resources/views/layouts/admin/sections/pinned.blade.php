@props(['open'=>true])
<x-main::accordion-editor :title="__('pinned')" :open="$open">
    <x-main::input.select id="article_id" class="block w-full" name="pinned">
        <option value="0" {{isset($instance) && !$instance->pinned  ? 'selected' : ''}} >
            {{__('no')}}
        </option>
        <option value="1" {{isset($instance) && $instance->pinned ? 'selected' : ''}} >
            {{__('yes')}}
        </option>
    </x-main::input.select>
    <x-main::input.error :messages="$errors->get('pinned')" class="mt-2"/>
</x-main::accordion-editor>
