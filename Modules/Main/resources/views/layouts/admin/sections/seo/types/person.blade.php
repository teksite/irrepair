
<section>
    <input id="seo_type" name="seo[meta][seo_type]" value="Person" class="hidden"  type="hidden"/>
    <input id="seo_type" name="seo[schema][seo_type]" value="Person" class="hidden"  type="hidden"/>

    <div class="mb-3">
        <x-main::input.label value="{{__('name')}}" for="schema_name"/>
        <x-main::input.text id="schema_name" name="seo[schema][name]" class="block w-full mb-3"
                            value="{{old('seo.schema.name') ?? $schema['name'] ?? ''}}"/>
        <x-main::input.error :messages="$errors->get('seo.schema.name')"/>
    </div>
    <div class="mb-3 grid gap-3 md:grid-cols-2">
        <div>
            <x-main::input.label value="{{__('url')}}" for="schema_url"/>
            <x-main::input.text id="schema_url" name="seo[schema][url]" class="block w-full mb-3" dir="ltr"
                                value="{{old('seo.schema.url') ?? $schema['url'] ?? ''}}"/>
            <x-main::input.error :messages="$errors->get('seo.schema.url')"/>
        </div>
        <div>
            <x-main::input.label value="{{__('image url')}}" for="schema_image"/>
            <x-main::input.text type="text" id="schema_image" name="seo[schema][image]" dir="ltr"
                                value="{{old('seo.schema.image') ?? $schema['image'] ?? ''}}"
                                class="block w-full mb-3"/>
            <x-main::input.error :messages="$errors->get('seo.schema.image')"/>
        </div>
    </div>
    <div class="mb-3 grid gap-3 md:grid-cols-2">
        <div>
            <x-main::input.label value="{{__('job title')}}" for="schema_jobTitle"/>
            <x-main::input.text id="schema_jobTitle" name="seo[schema][jobTitle]" class="block w-full mb-3"
                                value="{{old('seo.schema.jobTitle') ?? $schema['jobTitle'] ?? ''}}"/>
            <x-main::input.error :messages="$errors->get('seo.schema.jobTitle')"/>
        </div>
        <div>
            <x-main::input.label value="{{__('works for')}}" for="schema_worksFor"/>
            <x-main::input.text type="text" id="schema_worksFor" name="seo[schema][worksFor]"
                                value="{{old('seo.schema.worksFor') ?? $schema['worksFor'] ?? ''}}"
                                class="block w-full mb-3"/>
            <x-main::input.error :messages="$errors->get('seo.schema.worksFor')"/>
        </div>
    </div>
    <section>

        <div id="schema-question-section">
                @foreach($schema['sameAs'] ?? [] as $social)
                    <div class="sameAsItems" id="sameAsItems-{{$loop->index}}">
                        <div class="mb-3 flex justify-between items-center gap-6">
                            <div class="w-full">
                                <x-main::input.label value="{{__('url')}}" for="social-{{$loop->index}}"/>
                                <x-main::input.text id="social-{{$loop->index}}" class="block w-full" type="text" name="seo[schema][sameAs][]"
                                                    :value="$social ?? '' "/>
                                <x-main::input.error :messages="$errors->get('seo.schema.sameAs')" class="mt-2"/>
                            </div>
                            <div>
                                <button role="button" type="button" class="text-red-900 deleteItemBtn"
                                        target="sameAsItems-{{$loop->index}}" onclick="document.getElementById('sameAsItems-{{$loop->index}}').remove()">&times;
                                </button>
                            </div>
                        </div>

                    </div>
                @endforeach
        </div>

        <hr class="mb-3">

        <div
            x-data="function handler() {
     return {
      fields: [],
       addNewField() {
          this.fields.push({
              txt1: ''
           });
        },
        removeField(index) {
           this.fields.splice(index, 1);
         }
      }
      }">
            <div>
                <template x-data="{'lngth' : document.querySelectorAll('.sameAsItems').length}"
                          x-for="(field, index) in fields" :key="index">
                    <div class="sameAsItems" x-bind:id="`sameAsItems-${index + lngth + 1}`">
                        <div class="mb-3 flex justify-between items-center gap-6">
                            <div class="w-full">
                                <x-main::input.label value="{{__('url')}}" x-bind:for="`sameAs-${index + lngth + 1}`"/>
                                <x-main::input.text x-bind:id="`sameAs-${index + lngth + 1}`" class="block w-full"
                                                    x-model="field.txt1"
                                                    type="text" x-bind:name="`seo[schema][sameAs][]`"
                                                    maxlength="255"/>
                            </div>
                            <div>
                                <button type="button" class="text-red-900" @click="removeField(index)">
                                    &times;
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
                <div>
                    <x-main::button.primary type="button" role="button" title="{{__('add social')}}" id="addSocial" @click="addNewField()">
                        {{__('add')}}
                    </x-main::button.primary>

                </div>
            </div>
        </div>
    </section>



</section>
