@props(['open'=>true])
<x-main::accordion-editor :title="__('items')" :open="$open">
    <section>
        @php
            $oldItem=old('extra.items') ?? ( isset($instance) && $instance->meta()->where('key','items')->first() ? $instance->meta()->where('key','items')->first()->value : [] ) ??  [];
        @endphp
        <div id="items-item">
            @if(isset($oldItem) && count($oldItem))
                @foreach($oldItem as $item)
                    <div class="itemItem"  id="itemItem-{{$loop->index}}">
                        <fieldset class="border border-gray-200 p-3 mb-6">
                            <legend>
                                <span class="p px-3">{{'#'.$loop->index + 1}}</span>
                            </legend>
                            <div class=" mb-3 flex justify-between items-center gap-6" >
                                <div class="w-full md:w-1/2">
                                    <x-main::input.label :value="__('title')"  for="items-{{$loop->index}}-title"/>
                                    <x-main::input.text name="extra[items][{{$loop->index}}][title]" type="text"
                                                        id="items-{{$loop->index}}-title" class="block w-full"
                                                        :value="$item['title'] ?? ''"/>
                                </div>
                                <div class="w-full md:w-1/2">
                                    <x-main::input.label :value="__('image')"  for="items-{{$loop->index}}-image"/>
                                    <x-main::input.text name="extra[items][{{$loop->index}}][image]" type="text"
                                                        id="items-{{$loop->index}}-image" class="block w-full"
                                                        :value="$item['image'] ?? ''"  dir="ltr"/>
                                </div>
                                <button type="button" class="text-red-900 dark:text-red-600 deleteItemBtn" target="itemItem-{{$loop->index}}">
                                    &times;
                                </button>
                            </div>
                            <div class="w-full">
                                <x-main::input.label :value="__('description')"  for="items-{{$loop->index}}-description"/>
                                <x-main::input.textarea name="extra[items][{{$loop->index}}][description]" type="text" id="items-{{$loop->index}}-description " class="block w-full"
                                >{{$item['description'] ?? ''}}</x-main::input.textarea>
                            </div>
                            <x-main::input.error :messages="$errors->get('items.'.$loop->index .'title')" class="my-2"/>
                            <x-main::input.error :messages="$errors->get('items.'.$loop->index .'image')" class="my-2"/>
                            <x-main::input.error :messages="$errors->get('items.'.$loop->index .'description')" class="my-2"/>
                        </fieldset>


                    </div>
                @endforeach
            @endif
            <div x-data="function handler(){return { fields: [], addNewField(){this.fields.push({ txt1: '',txt2:'',txt3:''});},removeField(index){ this.fields.splice(index, 1);}}}">
                <div>
                    <template x-data="{'lngth' : document.querySelectorAll('.itemItem').length}"
                              x-for="(field, index) in fields" :key="index">
                        <div class="itemItem" x-bind:id="`itemItem-${index + lngth + 1}`">
                            <fieldset class="border border-gray-200 p-3 mb-6 bg-slate-50">
                                <legend>
                                    <span class="px-3" x-text="`#${index + lngth + 1}`"></span>
                                </legend>

                                <div class="my-3 flex justify-between items-center gap-6">
                                    <div class="w-full md:w-1/2">
                                        <label x-text:="`{{__('title')}}`" x-bind:for="`extra[items][${index + lngth + 1}][title]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('feature')])}}</label>
                                        <x-main::input.text x-bind:id="`extra[items][${index + lngth + 1}][title]`"
                                                            class="block w-full" x-model="field.txt1" type="text"
                                                            x-bind:name="`extra[items][${index + lngth + 1}][title]`"/>
                                    </div>
                                    <div class="w-full md:w-1/2">
                                        <label x-text:="`{{__('image')}}`" x-bind:for="`extra[items][${index + lngth + 1}][image]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('feature')])}}</label>
                                        <x-main::input.text x-bind:id="`extra[items][${index + lngth + 1}][image]`"
                                                            class="block w-full" x-model="field.txt2" type="text"
                                                            x-bind:name="`extra[items][${index + lngth + 1}][image]`" dir="ltr"/>
                                    </div>
                                    <div>
                                        <button type="button" class="text-red-900 dark:text-red-600"
                                                @click="removeField(index)">
                                            &times;
                                        </button>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <div class="w-full">
                                        <label x-text:="`{{__('title')}}`" x-bind:for="`extra[items][${index + lngth + 1}][description]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('description')])}}</label>
                                        <x-main::input.textarea x-bind:id="`extra[items][${index + lngth + 1}][description]`"
                                                                class="block w-full" x-model="field.txt3" type="text"
                                                                x-bind:name="`extra[items][${index + lngth + 1}][description]`"></x-main::input.textarea>
                                    </div>
                                </div>
                            </fieldset>

                    </template>
                    <div class="my-3">
                        <x-main::button.primary type="button" role="button" title="{{__('add title')}}"
                                                id="addQuestion" @click="addNewField()">
                            {{__('add')}}
                        </x-main::button.primary>

                    </div>
                </div>
            </div>
        </div>
        <x-main::input.error :messages="$errors->get('items')" class="mt-2"/>

    </section>
</x-main::accordion-editor>
