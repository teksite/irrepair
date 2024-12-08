@props(['open'=>true])


@props(['open'=>true])
<x-main::accordion-editor :title="__('solution')" :open="$open">
    <section>

        @php
            $oldSolutions=old('solutions') ?? \Modules\Theme\Models\ThemeSetting::query()->where('key','homepage_solutions')->first()?->value ?? [];
        @endphp
        <div class="w-full">
            <x-main::input.label :value="__('description')" for="solutions-desc"/>
            <x-main::input.textarea name="solutions[description]" type="text"   id="solutions-desc" class="block w-full">{!! $oldSolutions['description'] ?? '' !!}</x-main::input.textarea>
        </div>
        <div id="solution-item">
            @if(isset($oldSolutions['item']) && count($oldSolutions['item']) )
                @foreach($oldSolutions['item'] as $solution)
                    <fieldset class="border border-gray-200 p-3 mb-6" id="solutionItem-{{$loop->index}}">
                        <legend>
                            <span class="px-3">{{'#'.$loop->index + 1}}</span>

                        </legend>
                        <div class="solutionItem"  >
                            <div class=" mb-3 flex justify-between items-center gap-6" >
                                <div class="w-full md:w-1/2">
                                    <x-main::input.label :value="__('title')" for="solutions-{{$loop->index}}-title"/>
                                    <x-main::input.text name="solutions[item][{{$loop->index}}][title]" type="text"   id="solutions-{{$loop->index}}-title" class="block w-full"  :value="$solution['title'] ?? ''"/>
                                </div>
                                <button type="button" class="text-red-900 dark:text-red-600 deleteItemBtn" target="solutionItem-{{$loop->index}}">
                                    &times;
                                </button>
                            </div>
                            <div class="w-full">
                                <x-main::input.label :value="__('image')" for="solutions-{{$loop->index}}-image"/>
                                <x-main::input.text id="solutions-{{$loop->index}}-image" class="block w-full"  name="solutions[item][{{$loop->index}}][image]" :value="$solution['image'] ?? ''" dir="ltr"/>
                            </div>
                            <div class="w-full">
                                <x-main::input.label :value="__('link')" for="solutions-{{$loop->index}}-link"/>
                                <x-main::input.text id="solutions-{{$loop->index}}-link" class="block w-full"  name="solutions[item][{{$loop->index}}][link]" :value="$solution['link'] ?? ''" dir="ltr"/>
                            </div>
                            <div class="w-full">
                                <x-main::input.label :value="__('description')" for="solutions-{{$loop->index}}-description"/>
                                <x-main::input.textarea id="solutions-{{$loop->index}}-description" class="block w-full"  name="solutions[item][{{$loop->index}}][description]" >{!! $solution['description'] ?? '' !!}</x-main::input.textarea>
                            </div>
                            <x-main::input.error :messages="$errors->get('solutions')" class="my-2"/>
                            <x-main::input.error :messages="$errors->get('solutions.*')" class="my-2"/>
                            <x-main::input.error :messages="$errors->get('solutions.'.$loop->index .'title')" class="my-2"/>
                            <x-main::input.error :messages="$errors->get('solutions.'.$loop->index .'image')" class="my-2"/>
                            <x-main::input.error :messages="$errors->get('solutions.'.$loop->index .'description')" class="my-2"/>
                            <x-main::input.error :messages="$errors->get('solutions.'.$loop->index .'link')" class="my-2"/>

                        </div>
                    </fieldset>
                @endforeach
            @endif
            <div x-data="function handler(){return { fields: [], addNewField(){this.fields.push({ title: '' ,image:'',link:'' , desc:''});},removeField(index){ this.fields.splice(index, 1);}}}">
                <div>
                    <template x-data="{'lngth' : document.querySelectorAll('.solutionItem').length}" x-for="(field, index) in fields" :key="index">
                        <fieldset class="border border-gray-200 p-3 mb-6 bg-slate-50">
                            <legend>
                                <span class="px-3" x-text="`#${index + lngth + 1}`"></span>
                            </legend>
                            <div class="solutionItem" x-bind:id="`solutionItem-${index + lngth + 1}`">
                                <div class="my-3 flex justify-between items-center gap-6">
                                    <div class="w-full md:w-1/2">
                                        <label x-text:="`{{__('titlel')}}`" x-bind:for="`solutions[item][${index + lngth + 1}][title]`"
                                               class="block font-medium text-xs text-gray-700 dark:text-gray-100 mb-2">{{__('title url')}}</label>
                                        <x-main::input.text x-bind:id="`solutions[item][${index + lngth + 1}][title]`" class="block w-full" x-model="title.txt1" type="text" x-bind:name="`solutions[item][${index + lngth + 1}][title]`"/>
                                    </div>
                                    <div>
                                        <button type="button" class="text-red-900 dark:text-red-600"
                                                @click="removeField(index)">
                                            &times;
                                        </button>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <x-main::input.label value="{{__('image')}}" x-bind:for="`solutions[item][${index + lngth + 1}][image]`"/>
                                    <x-main::input.text x-bind:id="`solutions[item][${index + lngth + 1}][image]`" class="block w-full" x-model="field.image" type="text"  x-bind:name="`solutions[item][${index + lngth + 1}][image]`" dir="ltr"/>
                                </div>
                                <div class="w-full">
                                    <x-main::input.label value="{{__('link')}}" x-bind:for="`solutions[item][${index + lngth + 1}][link]`"/>
                                    <x-main::input.text x-bind:id="`solutions[item][${index + lngth + 1}][link]`" class="block w-full" x-model="field.link" type="text"  x-bind:name="`solutions[item][${index + lngth + 1}][link]`" dir="ltr"/>
                                </div>
                                <div class="w-full">
                                    <x-main::input.label value="{{__('description')}}" x-bind:for="`solutions[item][${index + lngth + 1}][description]`"/>
                                    <x-main::input.textarea x-bind:id="`solutions[item][${index + lngth + 1}][description]`" class="block w-full" x-model="field.desc" type="text"  x-bind:name="`solutions[item][${index + lngth + 1}][description]`" ></x-main::input.textarea>
                                </div>
                            </div>
                        </fieldset>
                    </template>
                    <div class="my-3">
                        <x-main::button.primary type="button" role="button" title="{{__('add solution')}}" id="addBanner" @click="addNewField()">
                            {{__('add')}}
                        </x-main::button.primary>

                    </div>
                </div>
            </div>
        </div>
        <x-main::input.error :messages="$errors->get('solutions')" class="mt-2"/>

    </section>
</x-main::accordion-editor>

