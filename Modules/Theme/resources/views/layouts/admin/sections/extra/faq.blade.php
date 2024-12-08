@props(['open'=>"true",'label','key'])
@php($data=old('extra.'.$key) ??  $instance->getMeta($key)  ??  [])

@php($random=\Illuminate\Support\Str::random(6))

<x-main::accordion.single :title="__($label)" :open="$open">
    <section>
        <div id="dynamic-items-section">
            @foreach($data ?? [] as $item)
                @php($rand=$random.rand(10,9999))
                <div class="dynamicItemFAQ"  id="dynamicItemFAQ-{{$rand}}-{{$loop->index}}">
                    <fieldset class="fieldset">
                        <legend>
                            <span class="p px-3">{{'#'.$loop->index + 1}}</span>
                        </legend>
                        <div class=" mb-3 flex justify-between items-center gap-6" >
                            <div class="w-full">
                                <x-main::input.label :value="__('question')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-question"/>
                                <x-main::input.text name="extra[{{$key}}][{{$loop->index}}][question]" type="text"  id="dynamic-item-{{$rand}}-{{$loop->index}}-question" class="block w-full" :value="$item['question'] ?? ''"/>
                            </div>
                            <button type="button" class="text-red-900 dark:text-red-600 deleteItemBtn" data-target="dynamicItemFAQ-{{$rand}}-{{$loop->index}}">
                                &times;
                            </button>
                        </div>
                        <div class="w-full">
                            <x-main::input.label :value="__('answer')"  for="dynamic-item-{{$rand}}-{{$loop->index}}-answer"/>
                            <x-main::input.textarea name="extra[{{$key}}][{{$loop->index}}][answer]" type="text" id="dynamic-item-{{$rand}}-{{$loop->index}}-answer " class="block w-full">{{$item['answer'] ?? ''}}</x-main::input.textarea>
                        </div>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.'.$loop->index .'question')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('extra.'.$key.'.'.$loop->index .'answer')" class="my-2"/>
                    </fieldset>


                </div>
            @endforeach
            <div x-data="function handler(){return { fields: [], addNewField(){this.fields.push({ txt1: '',txt2:'',txt3:''});},removeField(index){ this.fields.splice(index, 1);}}}">
                <div>
                    <template x-data="{'lngth' : document.querySelectorAll('.dynamicItemFAQ').length}" x-for="(field, index) in fields" :key="index">
                        <div class="dynamicItemFAQ" x-bind:id="`dynamicItemFAQ-${index + lngth + 1}`">
                            <fieldset class="fieldset bg-slate-50">
                                <legend>
                                    <span class="px-3" x-text="`#${index + lngth + 1}`"></span>
                                </legend>

                                <div class="my-3 flex justify-between items-center gap-6">
                                    <div class="w-full">
                                        <label x-text:="`{{__('question')}}`" x-bind:for="`extra[{{$key}}][${index + lngth + 1}][question]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('question')])}}</label>
                                        <x-main::input.text x-bind:id="`extra[{{$key}}][${index + lngth + 1}][question]`" class="block w-full" x-model="field.txt1" type="text" x-bind:name="`extra[{{$key}}][${index + lngth + 1}][question]`"/>
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
                                        <label x-text:="`{{__('answer')}}`" x-bind:for="`extra[{{$key}}][${index + lngth + 1}][answer]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('new :title',['title'=>__('answer')])}}</label>
                                        <x-main::input.textarea x-bind:id="`extra[{{$key}}][${index + lngth + 1}][answer]`"  class="block w-full" x-model="field.txt3" type="text" x-bind:name="`extra[{{$key}}][${index + lngth + 1}][answer]`"></x-main::input.textarea>
                                    </div>
                                </div>
                            </fieldset>

                    </template>
                    <div class="my-3">
                        <x-main::button.primary type="button" role="button" title="{{__('add title')}}" id="addDynamicFAQ" @click="addNewField()">
                            {{__('add')}}
                        </x-main::button.primary>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main::accordion.single>
