@props(['open'=>"true",'label','key'])
@php($data=old('extra.'.$key) ??  $instance->getMeta($key)  ??  [])

@php($random=\Illuminate\Support\Str::random(6))

<x-main::accordion.single :title="__($label)" :open="$open">
    <section>
        <div id="dynamic-items-section">
            @foreach($data ?? [] as $item)
                @php($rand=$random.rand(10,9999))
                <div class="dynamicItemVideo"  id="dynamicItemVideo-{{$rand}}-{{$loop->index}}">
                    <fieldset class="fieldset">
                        <legend>
                            <span class="p px-3">{{'#'.$loop->index + 1}}</span>
                        </legend>
                        <div class="flex items-start justify-between">
                            <div class="w-full md:w-1/2">
                                <x-main::input.label :value="__('title')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-title"/>
                                <x-main::input.text name="extra[{{$key}}][{{$loop->index}}][title]" type="text"  id="dynamic-item-{{$rand}}-{{$loop->index}}-title" class="block w-full" :value="$item['title'] ?? ''"/>
                            </div>
                            <button type="button" class="text-red-900 dark:text-red-600 deleteItemBtn" data-target="dynamicItemVideo-{{$rand}}-{{$loop->index}}">
                                &times;
                            </button>
                        </div>
                        <div class=" mb-3 grid lg:grid-cols-3 items-center gap-6" >
                            <div class="">
                                <x-main::input.label :value="__('video')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-video"/>
                                <x-main::input.text dir="ltr" name="extra[{{$key}}][{{$loop->index}}][video]" type="text"  id="dynamic-item-{{$rand}}-{{$loop->index}}-video" class="block w-full" :value="$item['video'] ?? ''"/>
                            </div>
                            <div class="">
                                <x-main::input.label :value="__('image')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-image"/>
                                <x-main::input.text dir="ltr" name="extra[{{$key}}][{{$loop->index}}][image]" type="text"  id="dynamic-item-{{$rand}}-{{$loop->index}}-image" class="block w-full" :value="$item['image'] ?? ''"/>
                            </div>
                            <div class="">
                                <x-main::input.label :value="__('icon')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-icon"/>
                                <x-main::input.text dir="ltr" name="extra[{{$key}}][{{$loop->index}}][icon]" type="text"  id="dynamic-item-{{$rand}}-{{$loop->index}}-icon" class="block w-full" :value="$item['icon'] ?? ''"/>
                            </div>

                        </div>
                        <div class="w-full">
                            <x-main::input.label :value="__('description')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-description"/>
                            <x-main::input.textarea name="extra[{{$key}}][{{$loop->index}}][description]" type="text" id="dynamic-item-{{$rand}}-{{$loop->index}}-description " class="block w-full">{{$item['description'] ?? ''}}</x-main::input.textarea>
                        </div>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.'.$loop->index .'title')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.'.$loop->index .'video')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.'.$loop->index .'image')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.'.$loop->index .'icon')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.'.$loop->index .'description')" class="my-2"/>
                    </fieldset>


                </div>
            @endforeach
            <div x-data="function handler(){return { fields: [], addNewField(){this.fields.push({ txt1: '',txt2:'',txt3:'',txt4:'',txt5:''});},removeField(index){ this.fields.splice(index, 1);}}}">
                <div>
                    <template x-data="{'lngth' : document.querySelectorAll('.dynamicItemVideo').length}" x-for="(field, index) in fields" :key="index">
                        <div class="dynamicItemVideo" x-bind:id="`dynamicItemVideo-${index + lngth + 1}`">
                            <fieldset class="fieldset bg-slate-50">
                                <legend>
                                    <span class="px-3" x-text="`#${index + lngth + 1}`"></span>
                                </legend>
                                <div class="flex items-start justify-between">
                                    <div class="w-full md:w-1/2">
                                        <label x-text:="`{{__('title')}}`" x-bind:for="`extra[{{$key}}][${index + lngth + 1}][title]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('feature')])}}</label>
                                        <x-main::input.text x-bind:id="`extra[{{$key}}][${index + lngth + 1}][title]`" class="block w-full" x-model="field.txt1" type="text" x-bind:name="`extra[{{$key}}][${index + lngth + 1}][title]`"/>
                                    </div>
                                    <button type="button" class="text-red-900 dark:text-red-600"
                                            @click="removeField(index)">
                                        &times;
                                    </button>
                                </div>
                                <div class=" mb-3 grid lg:grid-cols-3 items-center gap-6" >
                                    <div class="">
                                        <label dir="ltr" x-text:="`{{__('video')}}`" x-bind:for="`extra[{{$key}}][${index + lngth + 1}][video]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('video')])}}</label>
                                        <x-main::input.text x-bind:id="`extra[{{$key}}][${index + lngth + 1}][video]`" class="block w-full" x-model="field.txt2" type="text" x-bind:name="`extra[{{$key}}][${index + lngth + 1}][video]`"/>
                                    </div>
                                    <div class="">
                                        <label dir="ltr" x-text:="`{{__('image')}}`" x-bind:for="`extra[{{$key}}][${index + lngth + 1}][image]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('image')])}}</label>
                                        <x-main::input.text x-bind:id="`extra[{{$key}}][${index + lngth + 1}][image]`" class="block w-full" x-model="field.txt3" type="text" x-bind:name="`extra[{{$key}}][${index + lngth + 1}][image]`"/>
                                    </div>
                                    <div class="">
                                        <label dir="ltr" x-text:="`{{__('icon')}}`" x-bind:for="`extra[{{$key}}][${index + lngth + 1}][icon]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('icon')])}}</label>
                                        <x-main::input.text x-bind:id="`extra[{{$key}}][${index + lngth + 1}][icon]`" class="block w-full" x-model="field.txt4" type="text" x-bind:name="`extra[{{$key}}][${index + lngth + 1}][icon]`"/>
                                    </div>

                                </div>
                                <div class="my-3">
                                    <div class="w-full">
                                        <label x-text:="`{{__('description')}}`" x-bind:for="`extra[{{$key}}][${index + lngth + 1}][description]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('description')])}}</label>
                                        <x-main::input.textarea x-bind:id="`extra[{{$key}}][${index + lngth + 1}][description]`"  class="block w-full" x-model="field.txt5" type="text" x-bind:name="`extra[{{$key}}][${index + lngth + 1}][description]`"></x-main::input.textarea>
                                    </div>
                                </div>
                            </fieldset>
                    </template>
                    <div class="my-3">
                        <x-main::button.primary type="button" role="button" title="{{__('add title')}}" id="addDynamicVideo" @click="addNewField()">
                            {{__('add')}}
                        </x-main::button.primary>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main::accordion.single>
