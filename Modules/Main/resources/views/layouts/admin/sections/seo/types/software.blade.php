
<section>
    <input id="seo_type" name="seo[meta][seo_type]" value="SoftwareApplication" class="hidden"  type="hidden"/>
    <input id="seo_type" name="seo[schema][seo_type]" value="SoftwareApplication" class="hidden"  type="hidden"/>
    <div id="schema-title-section">
            @foreach($schema['software'] ?? [] as $software)
                <fieldset class="fieldset" id="software-{{$loop->index}}">
                    <legend>
                        <span class="px-3">#{{$loop->index + 1}}</span>
                    </legend>
                    <div class="softwareItem" id="softwareItem-{{$loop->index}}">
                        <div class="mb-3 flex justify-between items-center gap-6">
                            <div class="w-full">
                                <x-main::input.label value="{{__('title')}}" for="title-{{$loop->index}}"/>
                                <x-main::input.text id="title-{{$loop->index}}" class="block w-full" type="text" name="seo[schema][software][{{$loop->index}}][title]"
                                                    maxlength="255" :value="$software['title'] ?? ''"/>
                                <x-main::input.error :messages="$errors->get('seo.schema.software.*.title')" class="mt-2"/>
                            </div>
                            <div>
                                <button role="button" type="button" class="text-red-900 deleteItemBtn"
                                        target="faqItem-{{$loop->index}}" onclick="document.getElementById('software-{{$loop->index}}').remove()">&times;
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <x-main::input.label for="description-{{$loop->index}}" value="{{__('description')}}"/>
                            <x-main::input.textarea id="description-{{$loop->index}}" class="block w-full"
                                                    name="seo[schema][software][{{$loop->index}}][description]">{{$software['description'] ?? '' }}</x-main::input.textarea>
                            <x-main::input.error :messages="$errors->get('seo.schema.software.*.description')" class="mt-2"/>

                        </div>
                        <div class="mb-3 grid md:grid-cols-2 gap-3">
                            <div>
                                <x-main::input.label value="{{__('operating systems')}}" for="operatingSystem-{{$loop->index}}"/>
                                <x-main::input.text id="operatingSystem-{{$loop->index}}" class="block w-full"
                                                    maxlength="255"  name="seo[schema][software][{{$loop->index}}][operatingSystem]"
                                                    :value="$software['operatingSystem'] ?? ''"/>
                            </div>
                            <div>
                                <x-main::input.label value="{{__('category')}}" for="applicationCategory-{{$loop->index}}"/>
                                <x-main::input.select id="applicationCategory-{{$loop->index}}" class="block w-full" name="seo[schema][software][{{$loop->index}}][applicationCategory]">
                                    @foreach(config('global.seoschematype.pageType.SoftwareApplication.applicationCategory') as $type=>$title)
                                        <option value="{{$type}}" {{$software['applicationCategory']==$type ? 'selected': ''}}>{{__($title)}}</option>
                                    @endforeach
                                </x-main::input.select>
                            </div>
                            <div>
                                <x-main::input.label value="{{__('url')}}" for="url-{{$loop->index}}"/>
                                <x-main::input.text id="url-{{$loop->index}}" class="block w-full"
                                                    maxlength="255"  name="seo[schema][software][{{$loop->index}}][url]"
                                                    :value="$software['url'] ?? ''"/>
                            </div>
                        </div>

                        <div class="mb-3 grid md:grid-cols-2 gap-3">
                            <div>
                                <x-main::input.label value="{{__('application suite')}}" for="applicationSuite-{{$loop->index}}"/>
                                <x-main::input.text id="applicationSuite-{{$loop->index}}" class="block w-full" name="seo[schema][software][{{$loop->index}}][applicationSuite]"
                                                    :value="$software['applicationSuite'] ?? '' "/>
                            </div>
                            <div>
                                <x-main::input.label value="{{__('download url')}}" for="downloadUrl-{{$loop->index}}"/>
                                <x-main::input.text id="downloadUrl-{{$loop->index}}" class="block w-full" name="seo[schema][software][{{$loop->index}}][downloadUrl]"
                                                    :value="$software['downloadUrl'] ?? '' "/>
                            </div>

                        </div>
                    </div>

                </fieldset>
            @endforeach
    </div>
    <hr class="mb-3">
    <div x-data="function handler() {
     return {
      fields: [],
       addNewField() {
          this.fields.push({
              txt1: '',txt2: '',txt3: '',txt4: '',txt5: '',txt6: '',txt7: '',txt8: '',txt9: ''});
        },
        removeField(index) {
           this.fields.splice(index, 1);
         }
      }
      }">
        <div>
            <template x-data="{'lngth' : document.querySelectorAll('.softwareItem').length}" x-for="(field, index) in fields"
                      :key="index">
                <fieldset class="fieldset">
                    <legend>
                        <span class="px-3" x-text="`#${index + lngth + 1}`"></span>
                    </legend>
                    <div class="softwareItem" x-bind:id="`softwareItem-${index + lngth + 1}`">
                        <div class="mb-3 flex justify-between items-center gap-6">
                            <div class="w-full">
                                <x-main::input.label value="{{__('title')}}" x-bind:for="`title-${index + lngth + 1}`"/>
                                <x-main::input.text x-bind:id="`title-${index + lngth + 1}`" class="block w-full"
                                                    x-model="field.txt1" type="text" x-bind:name="`seo[schema][software][${index + lngth + 1}][title]`"
                                                    maxlength="255"/>
                                <x-main::input.error :messages="$errors->get('meta.faq.*.title')" class="mt-2"/>
                            </div>
                            <div>
                                <button type="button" class="text-red-900"
                                        @click="removeField(index)">
                                    &times;
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <x-main::input.label x-bind:for="`description-${index + lngth + 1}`"
                                                 value="{{__('description')}}"/>
                            <x-main::input.textarea x-bind:id="`description-${index + lngth + 1}`" class="block w-full"
                                                    x-model="field.txt2" x-bind:name="`seo[schema][software][${index + lngth + 1}][description]`"></x-main::input.textarea>

                        </div>
                        <div class="mb-3 grid md:grid-cols-2 gap-3">
                            <div>
                                <x-main::input.label value="{{__('operatingSystem')}}" x-bind:for="`operatingSystem-${index + lngth + 1}`"/>
                                <x-main::input.text x-bind:id="`operatingSystem-${index + lngth + 1}`" class="block w-full"
                                                    x-model="field.txt3" maxlength="255"
                                                    x-bind:name="`seo[schema][software][${index + lngth + 1}][operatingSystem]`"/>
                            </div>
                            <div>
                                <x-main::input.label value="{{__('category')}}" x-bind:for="`applicationCategory-${index + lngth + 1}`"/>
                                <x-main::input.select x-bind:id="`applicationCategory-${index + lngth + 1}`" class="block w-full"
                                                      x-model="field.txt4"
                                                      x-bind:name="`seo[schema][software][${index + lngth + 1}][applicationCategory]`">
                                    @foreach(config('global.seoschematype.pageType.SoftwareApplication.applicationCategory') as $type=>$title)
                                        <option value="{{$type}}">{{__($title)}}</option>
                                    @endforeach
                                </x-main::input.select>
                            </div>
                            <div>
                                <x-main::input.label value="{{__('url')}}" x-bind:for="`url-${index + lngth + 1}`"/>
                                <x-main::input.date x-bind:id="`url-${index + lngth + 1}`" class="block w-full"
                                                    x-model="field.txt5" maxlength="255" type="text"
                                                    x-bind:name="`seo[schema][software][${index + lngth + 1}][url]`"/>
                            </div>
                        </div>

                        <div class="mb-3 grid md:grid-cols-2 gap-3">
                            <div>
                                <x-main::input.label value="{{__('application suite')}}"
                                                     x-bind:for="`applicationSuite-${index + lngth + 1}`"/>
                                <x-main::input.text x-bind:id="`applicationSuite-${index + lngth + 1}`" class="block w-full"
                                                    x-model="field.txt6"
                                                    x-bind:name="`seo[schema][software][${index + lngth + 1}][applicationSuite]`"/>
                            </div>
                            <div>
                                <x-main::input.label value="{{__('download url')}}"
                                                     x-bind:for="`downloadUrl-${index + lngth + 1}`"/>
                                <x-main::input.text x-bind:id="`downloadUrl-${index + lngth + 1}`" class="block w-full"
                                                    x-model="field.txt7"
                                                    x-bind:name="`seo[schema][software][${index + lngth + 1}][downloadUrl]`"/>
                            </div>
                        </div>
                    </div>


                </fieldset>
            </template>
            <div>
                <x-main::button.primary type="button" role="button" title="{{__('add title')}}" id="addQuestion"
                                        @click="addNewField()">
                    {{__('add')}}
                </x-main::button.primary>

            </div>
        </div>
    </div>
</section>
