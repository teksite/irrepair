@props(['name'=>'body' ,'column'=>'body', 'title'=>'body' ,'open'=>true])

<div>
    <x-main::accordion.single :title="$title" :open="$open">
        <x-main::input.textarea  id="body-{{$name}}" class="block w-full" name="{{$name}}" rows="3">{{old($name) ?? $instance->$column ?? ''}}</x-main::input.textarea>
    </x-main::accordion.single>
    <x-main::input.error :messages="$errors->get($name)" class="mt-2"/>

</div>
