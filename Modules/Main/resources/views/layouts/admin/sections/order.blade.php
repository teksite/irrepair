@props(['open'=>'false' ,'default'=>1])
<div>
    <x-main::accordion.single :title="__('order')" open="{{$open}}">
        <x-main::input.text type="number" name="order" id="order" class="block w-full" aria-label="{{__('order')}}" :value="$instance?->order ?? $default ?? 1"/>
    </x-main::accordion.single>
    <x-main::input.error :messages="$errors->get('order')" class="mt-2"/>
</div>
