@props(['open'=>"true",'label','key' , 'data'=>null ])
@php($data=old('extra.'.$key) ??  $instance?->getMeta($key)  ?? $data  ?? [])
@php($random=\Illuminate\Support\Str::random(6))

<x-main::accordion.single :title="__($label)" :open="$open">
    <section>
        <div id="dynamic-items-section">
            <div class="md:flex gap-6 items-center">
                <div class="w-full">
                    <x-main::input.label :value="__('title')"  for="dynamic-item-{{$random}}-static-title"/>
                    <x-main::input.text name="extra[{{$key}}][title]" type="text"  id="dynamic-item-{{$random}}-static-title" class="block w-full" :value="$data['title'] ?? ''"/>
                </div>
                <div class="w-full">
                    <x-main::input.label :value="__('image')"  for="dynamic-item-{{$random}}-static-image"/>
                    <x-main::input.text dir="ltr" name="extra[{{$key}}][image]" type="text"  id="dynamic-item-{{$random}}-static-image" class="block w-full" :value="$data['image'] ?? ''"/>
                </div>
            </div>
            <div class="w-full">
                <x-main::input.label :value="__('description')"  for="dynamic-item-{{$random}}-static-description"/>
                <x-main::input.textarea name="extra[{{$key}}][description]" type="text"  id="dynamic-item-{{$random}}-static-description" class="block w-full">{{$data['description'] ?? ''}}</x-main::input.textarea>
            </div>

            @foreach($data['items'] ?? [] as $item)
                @php($rand=$random.rand(10,9999))
                <div class="dynamicItemContent"  id="dynamicItemContent-{{$rand}}-{{$loop->index}}">
                    <fieldset class="fieldset">
                        <legend>
                            <span class="p px-3">{{'#'.$loop->index + 1}}</span>
                        </legend>
                        <div class=" mb-3 flex justify-between items-center gap-6" >
                            <div class="w-full md:w-1/2">
                                <x-main::input.label :value="__('title')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-title"/>
                                <x-main::input.text name="extra[{{$key}}][items][{{$loop->index}}][title]" type="text"  id="dynamic-item-{{$rand}}-{{$loop->index}}-title" class="block w-full" :value="$item['title'] ?? ''"/>
                            </div>
                            <div class="w-full md:w-1/2">
                                <x-main::input.label :value="__('image')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-image"/>
                                <x-main::input.text name="extra[{{$key}}][items][{{$loop->index}}][image]" type="text" id="dynamic-item-{{$rand}}-{{$loop->index}}-image" class="block w-full" :value="$item['image'] ?? ''"  dir="ltr"/>
                            </div>
                            <button type="button" class="text-red-900 dark:text-red-600 deleteItemBtn" data-target="dynamicItemContent-{{$rand}}-{{$loop->index}}">
                                &times;
                            </button>
                        </div>
                        <div class="w-full">
                            <x-main::input.label :value="__('description')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-description"/>
                            <x-main::input.textarea name="extra[{{$key}}][items][{{$loop->index}}][description]" type="text" id="dynamic-item-{{$rand}}-{{$loop->index}}-description " class="block w-full">{{$item['description'] ?? ''}}</x-main::input.textarea>
                        </div>
                        <div class="mb-3">
                            <x-main::input.label :value="__('url')" for="url-{{$random}}" />
                            <div class="grid md:grid-cols-2 gap-6 items-center">
                                <div class="w-full">
                                    <x-main::input.label :value="__('title')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-url-title"/>
                                    <x-main::input.text name="extra[{{$key}}][items][{{$loop->index}}][url][title]" type="text" id="dynamic-item-{{$rand}}-{{$loop->index}}-url-title" class="block w-full" :value="$item['url']['title'] ?? ''"  dir="ltr"/>
                                </div>
                                <div class="w-full">
                                    <x-main::input.label :value="__('address')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-url-address"/>
                                    <x-main::input.text name="extra[{{$key}}][items][{{$loop->index}}][url][address]" type="text" id="dynamic-item-{{$rand}}-{{$loop->index}}-url-address" class="block w-full" :value="$item['url']['address'] ?? ''"  dir="ltr"/>
                                </div>
                            </div>
                        </div>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.title')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.description')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.image')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.items.'.$loop->index .'title')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.items.'.$loop->index .'image')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.items.'.$loop->index .'description')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.items.'.$loop->index .'url')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.items.'.$loop->index .'url.*')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.items.'.$loop->index .'url.title')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.items.'.$loop->index .'url.address')" class="my-2"/>
                    </fieldset>


                </div>
            @endforeach
            <div x-data="function handler(){return { fields: [], addNewField(){this.fields.push({ txt1: '',txt2:'',txt3:'',txt4:'',txt5:'',txt6:''});},removeField(index){ this.fields.splice(index, 1);}}}">
                <div>
                    <template x-data="{'lngth' : document.querySelectorAll('.dynamicItemContent').length}" x-for="(field, index) in fields" :key="index">
                        <div class="dynamicItemContent" x-bind:id="`dynamicItemContent-${index + lngth + 1}`">
                            <fieldset class="fieldset bg-slate-50">
                                <legend>
                                    <span class="px-3" x-text="`#${index + lngth + 1}`"></span>
                                </legend>

                                <div class="my-3 flex justify-between items-center gap-6">
                                    <div class="w-full md:w-1/2">
                                        <label x-text:="`{{__('title')}}`" x-bind:for="`extra[{{$key}}][items][${index + lngth + 1}][title]`"
                                               class="block font-medium text-xs text-gray-700">{{__('new :title',['title'=>__('feature')])}}</label>
                                        <x-main::input.text x-bind:id="`extra[{{$key}}][items][${index + lngth + 1}][title]`" class="block w-full" x-model="field.txt1" type="text" x-bind:name="`extra[{{$key}}][items][${index + lngth + 1}][title]`"/>
                                    </div>
                                    <div class="w-full md:w-1/2">
                                        <label x-text:="`{{__('image')}}`" x-bind:for="`extra[{{$key}}][items][${index + lngth + 1}][image]`" class="block font-medium text-xs text-gray-700">{{__('new :title',['title'=>__('feature')])}}</label>
                                        <x-main::input.text x-bind:id="`extra[{{$key}}][items][${index + lngth + 1}][image]`" class="block w-full" x-model="field.txt2" type="text" x-bind:name="`extra[{{$key}}][items][${index + lngth + 1}][image]`" dir="ltr"/>
                                    </div>
                                    <div>
                                        <button type="button" class="text-red-900 dark:text-red-600"
                                                @click="removeField(index)">
                                            &times;
                                        </button>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label x-text:="`{{__('description')}}`" x-bind:for="`extra[{{$key}}][items][${index + lngth + 1}][description]`"
                                           class="block font-medium text-xs text-gray-700">{{__('new :title',['title'=>__('description')])}}</label>
                                    <x-main::input.textarea x-bind:id="`extra[{{$key}}][items][${index + lngth + 1}][description]`"  class="block w-full" x-model="field.txt3" type="text" x-bind:name="`extra[{{$key}}][items][${index + lngth + 1}][description]`"></x-main::input.textarea>
                                </div>
                                <div class="mb-3">
                                    <label x-text:="`{{__('url')}}`" x-bind:for="`extra[{{$key}}][items][${index + lngth + 1}][url]`"
                                           class="block font-medium text-xs text-gray-700">{{__('new :title',['title'=>__('url')])}}</label>
                                    <div class="grid md:grid-cols-2 gap-6 items-center">
                                        <div class="w-full">
                                            <label x-text:="`{{__('title')}}`" x-bind:for="`extra[{{$key}}][items][${index + lngth + 1}][url][title]`" class="block font-medium text-xs text-gray-700">{{__('new :title',['title'=>__('title')])}}</label>
                                            <x-main::input.text x-bind:id="`extra[{{$key}}][items][${index + lngth + 1}][url][title]`" class="block w-full" x-model="field.txt5" type="text" x-bind:name="`extra[{{$key}}][items][${index + lngth + 1}][url][title]`" />
                                        </div>
                                        <div class="w-full">
                                            <label x-text:="`{{__('address')}}`" x-bind:for="`extra[{{$key}}][items][${index + lngth + 1}][url][address]`" class="block font-medium text-xs text-gray-700">{{__('new :title',['title'=>__('address')])}}</label>
                                            <x-main::input.text x-bind:id="`extra[{{$key}}][items][${index + lngth + 1}][url][address]`" class="block w-full" x-model="field.txt6" type="text" x-bind:name="`extra[{{$key}}][items][${index + lngth + 1}][url][address]`" />
                                        </div>

                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </template>
                    <div class="my-3">
                        <x-main::button.primary type="button" role="button" title="{{__('add title')}}" id="addDynamicContent" @click="addNewField()">
                            {{__('add')}}
                        </x-main::button.primary>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main::accordion.single>
