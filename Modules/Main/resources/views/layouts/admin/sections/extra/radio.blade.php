@props(['open'=>"true",'label','key' ,'options'])
@php
    $data = isset($instance) ? $instance->getMeta($key) : [];
@endphp
<div>
    <x-main::accordion.single :title="$label" :open="$open">
        <fieldset class="fieldset">
            <legend>
                <h4>
                    {{$label}}
                </h4>
            </legend>
        @foreach($options as $k=>$v)
                @php($rand=rand(10,1000))
               <div class="flex items-center gap-3">
                   <x-main::input.radio class="" value="{{$k}}" id="title-{{$rand}}-radio" name="extra[{{$key}}]" :checked="isset($data) && $data[0] ? $data[0]==$k : $loop->index ===0 "/>
                   <x-main::input.label class="!mb-0" :value="__($v)" for="title-{{$rand}}-radio" />
               </div>
            @endforeach
        </fieldset>
    </x-main::accordion.single>
    <x-main::input.error :messages="$errors->get('extra.'.$key.'.radio')" class="mt-2"/>
</div>
