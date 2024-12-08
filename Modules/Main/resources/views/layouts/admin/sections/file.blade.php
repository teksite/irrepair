@props(['name'=>'file' ,'column'=>'file', 'title'=>'file' ,'open'=>true])
@php($random='file-'.rand(100,900))
<x-main::accordion.single :title="__($title)" :open="$open">
    <x-main::input.text id="{{$random}}" class="block w-full file-selector" dir="ltr" name="{{$name}}" :value="old($name) ?? $instance->$column ?? ''"/>
    <x-main::input.error :messages="$errors->get($name)" class="mt-2"/>
</x-main::accordion.single>
