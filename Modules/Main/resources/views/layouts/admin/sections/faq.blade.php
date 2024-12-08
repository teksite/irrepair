@props(['open'=>true])
<x-main::accordion.single :title="__('faq')" :open="$open">
    <section>
        @php
            $oldFaqs=old('faq') ?? (isset($instance) && $instance?->faq ? $instance->faq->toArray() : (isset($instance) &&  $instance->meta() ? $instance->meta()->where('key' ,'faq')->first()?->value : [])) ?? [];
        @endphp
        <div id="faq-item">
            @if(count($oldFaqs))
                <fieldset class="fieldset">
                    <legend>
                        <h3>
                            {{__('faq')}}
                        </h3>
                    </legend>
                    @foreach($oldFaqs as $faq)
                        <div class="faqItem"  id="faqItem-{{$loop->index}}">
                            <div class=" mb-3 flex justify-between items-center gap-6" >
                                <div class="w-full">
                                    <span class="p">{{'#'.$loop->index + 1}}</span>
                                    <x-main::input.label :value="__('question')" for="faq-{{$loop->index}}-question"/>
                                    <x-main::input.text name="faq[{{$loop->index}}][question]" type="text"
                                                        id="faq-{{$loop->index}}-question" class="block w-full"
                                                        :value="$faq['question'] ?? ''"/>
                                </div>
                                <button type="button" class="text-red-900 dark:text-red-600 deleteItemBtn"
                                        target="faqItem-{{$loop->index}}">
                                    &times;
                                </button>
                            </div>
                            <div class="w-full">
                                <x-main::input.label :value="__('question')" for="faq-{{$loop->index}}-question"/>
                                <x-main::input.textarea id="faq-{{$loop->index}}-question"
                                                        class="block w-full"
                                                        name="faq[{{$loop->index}}][answer]">{{$faq['answer'] ?? ''}}</x-main::input.textarea>
                            </div>
                            <x-main::input.error :messages="$errors->get('faq.'.$loop->index .'question')" class="my-2"/>
                            <x-main::input.error :messages="$errors->get('faq.'.$loop->index .'answer')" class="my-2"/>
                            <x-main::input.error :messages="$errors->get('faq.'.$loop->index)" class="my-2"/>
                        </div>
                    @endforeach
                </fieldset>

            @endif
            <div
                x-data="function handler(){return { fields: [], addNewField(){this.fields.push({ txt1: ''});},removeField(index){ this.fields.splice(index, 1);}}}">
                <div>
                    <template x-data="{'lngth' : document.querySelectorAll('.faqItem').length}"
                              x-for="(field, index) in fields" :key="index">
                        <div class="faqItem" x-bind:id="`faqItem-${index + lngth + 1}`">
                            <div class="my-3 flex justify-between items-center gap-6">
                                <div class="w-full">
                                    <span x-text="`#${index + lngth + 1}`"></span>
                                    <label x-text:="`{{__('question')}}`"
                                           x-bind:for="`faq[${index + lngth + 1}]`"
                                           class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('faq')])}}</label>
                                    <x-main::input.text x-bind:id="`faq[${index + lngth + 1}]`"
                                                        class="block w-full" x-model="field.txt1" type="text"
                                                        x-bind:name="`faq[${index + lngth + 1}][question]`"/>
                                </div>
                                <div>
                                    <button type="button" class="text-red-900 dark:text-red-600"
                                            @click="removeField(index)">
                                        &times;
                                    </button>
                                </div>
                            </div>
                            <div class="w-full">
                                <x-main::input.label value="{{__('answer')}}" x-bind:for="`faq[${index + lngth + 1}][answer]`"/>
                                <x-main::input.textarea x-bind:id="`faq[${index + lngth + 1}][answer]`"
                                                  class="block w-full" x-model="field.txt2" type="text"
                                                  x-bind:name="`faq[${index + lngth + 1}][answer]`"></x-main::input.textarea>
                            </div>
                        </div>
                    </template>
                    <div class="my-3">
                        <x-main::button.primary type="button" role="button" title="{{__('add question')}}"
                                                id="addQuestion" @click="addNewField()">
                            {{__('add')}}
                        </x-main::button.primary>

                    </div>
                </div>
            </div>
        </div>
        <x-main::input.error :messages="$errors->get('faq')" class="mt-2"/>

    </section>
</x-main::accordion.single>
