@props(['open'=>true])
<x-main::accordion.single :title="__('chapter')" :open="$open">
    <section>
        @php
            $oldChapters=old('chapters') ?? (isset($instance) && $instance?->chapters ? $instance->chapters->toArray() : []) ?? [];
        @endphp
        <div id="chapter-item">
            @if(count($oldChapters))
                <fieldset class="fieldset">
                    <legend>
                        <h3>
                            {{__('chapter')}}
                        </h3>
                    </legend>
                    @foreach($oldChapters as $chapter)
                        <div class="chapterItem"  id="chapterItem-{{$loop->index}}">
                            <div class=" mb-3 flex justify-between items-center gap-6" >
                                <div class="w-full">
                                    <span class="p">{{'#'.$loop->index + 1}}</span>
                                    <x-main::input.label :value="__('title')" for="chapter-{{$loop->index}}-title"/>
                                    <x-main::input.text name="chapters[{{$loop->index}}][title]" type="text"
                                                        id="chapter-{{$loop->index}}-title" class="block w-full"
                                                        :value="$chapter['title'] ?? ''"/>
                                </div>
                                <button type="button" class="text-red-900 dark:text-red-600 deleteItemBtn"
                                        target="chapterItem-{{$loop->index}}">
                                    &times;
                                </button>
                            </div>
                            <div class="w-full">
                                <x-main::input.label :value="__('title')" for="chapter-{{$loop->index}}-title"/>
                                <x-main::input.textarea id="chapter-{{$loop->index}}-title"
                                                        class="block w-full"
                                                        name="chapters[{{$loop->index}}][body]">{{$chapter['body'] ?? ''}}</x-main::input.textarea>
                            </div>
                            <x-main::input.error :messages="$errors->get('chapter.'.$loop->index .'title')" class="my-2"/>
                            <x-main::input.error :messages="$errors->get('chapter.'.$loop->index .'body')" class="my-2"/>
                            <x-main::input.error :messages="$errors->get('chapter.'.$loop->index)" class="my-2"/>
                        </div>
                    @endforeach
                </fieldset>

            @endif
            <div
                x-data="function handler(){return { fields: [], addNewField(){this.fields.push({ txt1: ''});},removeField(index){ this.fields.splice(index, 1);}}}">
                <div>
                    <template x-data="{'lngth' : document.querySelectorAll('.chapterItem').length}"
                              x-for="(field, index) in fields" :key="index">
                        <div class="chapterItem" x-bind:id="`chapterItem-${index + lngth + 1}`">
                            <div class="my-3 flex justify-between items-center gap-6">
                                <div class="w-full">
                                    <span x-text="`#${index + lngth + 1}`"></span>
                                    <label x-text:="`{{__('title')}}`"
                                           x-bind:for="`chapter[${index + lngth + 1}]`"
                                           class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('chapter')])}}</label>
                                    <x-main::input.text x-bind:id="`chapter[${index + lngth + 1}]`"
                                                        class="block w-full" x-model="field.txt1" type="text"
                                                        x-bind:name="`chapters[${index + lngth + 1}][title]`"/>
                                </div>
                                <div>
                                    <button type="button" class="text-red-900 dark:text-red-600"
                                            @click="removeField(index)">
                                        &times;
                                    </button>
                                </div>
                            </div>
                            <div class="w-full">
                                <x-main::input.label value="{{__('body')}}" x-bind:for="`chapter[${index + lngth + 1}][body]`"/>
                                <x-main::input.textarea x-bind:id="`chapter[${index + lngth + 1}][body]`"
                                                  class="block w-full" x-model="field.txt2" type="text"
                                                  x-bind:name="`chapters[${index + lngth + 1}][body]`"></x-main::input.textarea>
                            </div>
                        </div>
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
        <x-main::input.error :messages="$errors->get('chapter')" class="mt-2"/>

    </section>
</x-main::accordion.single>
