@props(['open'=>true])
<x-main::accordion-editor :title="__('mentors')" :open="$open">
    <section>
        @php
            $oldPersons=old('extra.persons') ?? ( isset($instance) && $instance->meta()->where('key','persons')->first() ? $instance->meta()->where('key','persons')->first()->value : [] ) ??  [];
        @endphp
        <div id="mentors-item">
            @if(isset($oldPersons) && count($oldPersons))
                @foreach($oldPersons as $person)
                    <div class="personItem"  id="personItem-{{$loop->index}}">
                        <fieldset class="border border-gray-200 p-3 mb-6">
                            <legend>
                                <span class="p px-3">{{'#'.$loop->index + 1}}</span>
                            </legend>
                            <div class=" mb-3 flex justify-between items-center gap-6" >
                                <div class="w-full md:w-1/2">
                                    <x-main::input.label :value="__('title')"  for="persons-{{$loop->index}}-title"/>
                                    <x-main::input.text name="extra[persons][{{$loop->index}}][title]" type="text"
                                                        id="persons-{{$loop->index}}-title" class="block w-full"
                                                        :value="$person['title'] ?? ''"/>
                                </div>
                                <div class="w-full md:w-1/2">
                                    <x-main::input.label :value="__('image')"  for="persons-{{$loop->index}}-image"/>
                                    <x-main::input.text name="extra[persons][{{$loop->index}}][image]" type="text"
                                                        id="persons-{{$loop->index}}-image" class="block w-full"
                                                        :value="$person['image'] ?? ''"  dir="ltr"/>
                                </div>
                                <button type="button" class="text-red-900 dark:text-red-600 deleteItemBtn" target="personItem-{{$loop->index}}">
                                    &times;
                                </button>
                            </div>
                            <div class="w-full">
                                <x-main::input.label :value="__('description')"  for="persons-{{$loop->index}}-description"/>
                                <x-main::input.textarea name="extra[persons][{{$loop->index}}][description]" type="text" id="persons-{{$loop->index}}-description " class="block w-full"
                                >{{$person['description'] ?? ''}}</x-main::input.textarea>
                            </div>
                            <x-main::input.error :messages="$errors->get('persons.'.$loop->index .'title')" class="my-2"/>
                            <x-main::input.error :messages="$errors->get('persons.'.$loop->index .'image')" class="my-2"/>
                            <x-main::input.error :messages="$errors->get('persons.'.$loop->index .'description')" class="my-2"/>
                        </fieldset>


                    </div>
                @endforeach
            @endif
            <div x-data="function handler(){return { fields: [], addNewField(){this.fields.push({ txt1: '',txt2:'',txt3:''});},removeField(index){ this.fields.splice(index, 1);}}}">
                <div>
                    <template x-data="{'lngth' : document.querySelectorAll('.personItem').length}"
                              x-for="(field, index) in fields" :key="index">
                        <div class="personItem" x-bind:id="`personItem-${index + lngth + 1}`">
                            <fieldset class="border border-gray-200 p-3 mb-6 bg-slate-50">
                                <legend>
                                    <span class="px-3" x-text="`#${index + lngth + 1}`"></span>
                                </legend>

                                <div class="my-3 flex justify-between items-center gap-6">
                                    <div class="w-full md:w-1/2">
                                        <label x-text:="`{{__('title')}}`" x-bind:for="`extra[persons][${index + lngth + 1}][title]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('feature')])}}</label>
                                        <x-main::input.text x-bind:id="`extra[persons][${index + lngth + 1}][title]`"
                                                            class="block w-full" x-model="field.txt1" type="text"
                                                            x-bind:name="`extra[persons][${index + lngth + 1}][title]`"/>
                                    </div>
                                    <div class="w-full md:w-1/2">
                                        <label x-text:="`{{__('image')}}`" x-bind:for="`extra[persons][${index + lngth + 1}][image]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('feature')])}}</label>
                                        <x-main::input.text x-bind:id="`extra[persons][${index + lngth + 1}][image]`"
                                                            class="block w-full" x-model="field.txt2" type="text"
                                                            x-bind:name="`extra[persons][${index + lngth + 1}][image]`" dir="ltr"/>
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
                                        <label x-text:="`{{__('title')}}`" x-bind:for="`extra[persons][${index + lngth + 1}][description]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('description')])}}</label>
                                        <x-main::input.textarea x-bind:id="`extra[persons][${index + lngth + 1}][description]`"
                                                                class="block w-full" x-model="field.txt3" type="text"
                                                                x-bind:name="`extra[persons][${index + lngth + 1}][description]`"></x-main::input.textarea>
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
        <x-main::input.error :messages="$errors->get('persons')" class="mt-2"/>

    </section>
</x-main::accordion-editor>
