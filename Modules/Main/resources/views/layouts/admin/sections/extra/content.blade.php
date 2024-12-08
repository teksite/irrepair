@props(['open'=>"true",'label','key'])
@php
    $random=rand(10,1000);
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
         <div class="mb-3 md:w-1/2">
             <x-main::input.label :value="__('title')" for="title-{{$random}}" />
             <x-main::input.text class="block w-full mt-3" id="title-{{$random}}" name="extra[{{$key}}][title]" :value="old('extra.'.$key.'.title') ?? $data['title'] ?? ''"/>
         </div>
          <div class="mb-3">
              <x-main::input.label :value="__('body')" for="body-{{$random}}" />
              <x-main::input.textarea rows="6" class="block w-full mt-3" id="body-{{$random}}" name="extra[{{$key}}][body]" >{{old('extra.'.$key.'.image') ?? $data['body'] ?? ''}}</x-main::input.textarea>
          </div>
          <div class="mb-3">
              <x-main::input.label :value="__('image')" for="image-{{$random}}" />
              <x-main::input.text dir="ltr" class="block w-full mt-3" id="image-{{$random}}" name="extra[{{$key}}][image]" :value="old('extra.'.$key.'.image') ?? $data['image'] ?? ''"/>
          </div>
      </fieldset>
    </x-main::accordion.single>
    <x-main::input.error :messages="$errors->get('extra.'.$key.'.title')" class="mt-2"/>
    <x-main::input.error :messages="$errors->get('extra.'.$key.'.body')" class="mt-2"/>
    <x-main::input.error :messages="$errors->get('extra.'.$key.'.image')" class="mt-2"/>


</div>
