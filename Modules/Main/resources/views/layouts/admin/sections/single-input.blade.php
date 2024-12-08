@props(['open'=>"true" ,'name'=>'title' ,'column'=>'title' ,'title'=>'title' ,'accordion'=>true])
@php($random=rand(10 ,1000))
<x-main::accordion.single :title="$title" :open="$open" :accordion="$accordion">
    <x-main::input.text id="single-text-{{$random}}" class="block w-full"  name="{{$name}}" :value="old($name) ?? $instance->$column ?? ''"/>
            <x-main::input.error :messages="$errors->get($name)" class="mt-2"/>
</x-main::accordion.single>

