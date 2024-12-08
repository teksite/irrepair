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
             <x-main::input.checkbox id="title-{{$random}}" name="extra[{{$key}}][checkbox]" :checked="(old('extra.'.$key.'.checkbox') || isset($data['checkbox'])) ? 'checked' :'' "/>
         </div>

      </fieldset>
    </x-main::accordion.single>
    <x-main::input.error :messages="$errors->get('extra.'.$key.'.title')" class="mt-2"/>


</div>
