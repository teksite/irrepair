@props(['open'=>"true",'label','key'])
@php($data=old('extra.'.$key) ??  $instance->getMeta($key)  ??  [])

@php($random=\Illuminate\Support\Str::random(6))

<x-main::accordion.single :title="__($label)" :open="$open">
    <section>
        <div id="dynamic-items-section">
            @foreach($data ?? [] as $item)
                @php($rand=$random.rand(10,9999))
                <div class="dynamicItemImageGallery"  id="dynamicItemImageGallery-{{$rand}}-{{$loop->index}}">
                    <fieldset class="fieldset">
                        <legend>
                            <span class="p px-3">{{'#'.$loop->index + 1}}</span>
                        </legend>
                        <div class="mb-3 flex justify-between items-center">
                            <div class="w-full md:w-1/2">
                                <x-main::input.label :value="__('title')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-title"/>
                                <x-main::input.text name="extra[{{$key}}][{{$loop->index}}][title]" type="text"  id="dynamic-item-{{$rand}}-{{$loop->index}}-title" class="block w-full" :value="$item['title'] ?? ''"/>
                            </div>
                            <button type="button" class="text-red-900 dark:text-red-600 deleteItemBtn" data-target="dynamicItemImageGallery-{{$rand}}-{{$loop->index}}">
                                &times;
                            </button>
                        </div>
                        <div class=" mb-3 flex justify-between items-center gap-6" >
                            <div class="w-full md:w-1/2">
                                <x-main::input.label :value="__('thumbnail')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-thumbnail"/>
                                <x-main::input.text dir="ltr" name="extra[{{$key}}][{{$loop->index}}][thumbnail]" type="text"  id="dynamic-item-{{$rand}}-{{$loop->index}}-thumbnail" class="block w-full" :value="$item['thumbnail'] ?? ''"/>
                            </div>
                            <div class="w-full md:w-1/2">
                                <x-main::input.label :value="__('image')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-image"/>
                                <x-main::input.text  name="extra[{{$key}}][{{$loop->index}}][image]" type="text" id="dynamic-item-{{$rand}}-{{$loop->index}}-image" class="block w-full" :value="$item['image'] ?? ''"  dir="ltr"/>
                            </div>

                        </div>

                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.'.$loop->index .'thumbnail')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.'.$loop->index .'image')" class="my-2"/>
                    </fieldset>


                </div>
            @endforeach
            <div x-data="function handler(){return { fields: [], addNewField(){this.fields.push({ txt1: '',txt2:'',txt3:''});},removeField(index){ this.fields.splice(index, 1);}}}">
                <div>
                    <template x-data="{'lngth' : document.querySelectorAll('.dynamicItemImageGallery').length}" x-for="(field, index) in fields" :key="index">
                        <div class="dynamicItemImageGallery" x-bind:id="`dynamicItemImageGallery-${index + lngth + 1}`">
                            <fieldset class="fieldset bg-slate-50">
                                <legend>
                                    <span class="px-3" x-text="`#${index + lngth + 1}`"></span>
                                </legend>
                                <div class="mb-3 flex justify-between items-center">
                                    <div class="w-full md:w-1/2">
                                        <label x-text:="`{{__('title')}}`" x-bind:for="`extra[{{$key}}][${index + lngth + 1}][title]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('title')])}}</label>
                                        <x-main::input.text x-bind:id="`extra[{{$key}}][${index + lngth + 1}][title]`" class="block w-full" x-model="field.txt1" type="text" x-bind:name="`extra[{{$key}}][${index + lngth + 1}][title]`"/>
                                    </div>
                                    <button type="button" class="text-red-900 dark:text-red-600"
                                            @click="removeField(index)">
                                        &times;
                                    </button>
                                </div>

                                <div class="my-3 flex justify-between items-center gap-6">
                                    <div class="w-full md:w-1/2">
                                        <label x-text:="`{{__('thumbnail')}}`" x-bind:for="`extra[{{$key}}][${index + lngth + 1}][thumbnail]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('thumbnail')])}}</label>
                                        <x-main::input.text dir="ltr" x-bind:id="`extra[{{$key}}][${index + lngth + 1}][thumbnail]`" class="block w-full" x-model="field.txt2" type="text" x-bind:name="`extra[{{$key}}][${index + lngth + 1}][thumbnail]`"/>
                                    </div>
                                    <div class="w-full md:w-1/2">
                                        <label x-text:="`{{__('image')}}`" x-bind:for="`extra[{{$key}}][${index + lngth + 1}][image]`" class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('feature')])}}</label>
                                        <x-main::input.text x-bind:id="`extra[{{$key}}][${index + lngth + 1}][image]`" class="block w-full" x-model="field.txt3" type="text" x-bind:name="`extra[{{$key}}][${index + lngth + 1}][image]`" dir="ltr"/>
                                    </div>
                                </div>
                            </fieldset>

                    </template>
                    <div class="my-3">
                        <x-main::button.primary type="button" role="button" title="{{__('add title')}}" id="addDynamicGalley" @click="addNewField()">
                            {{__('add')}}
                        </x-main::button.primary>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main::accordion.single>
