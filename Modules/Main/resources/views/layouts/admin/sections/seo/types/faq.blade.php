
<section>
    <input id="seo_type" name="seo[meta][seo_type]" value="FAQPage" class="hidden"  type="hidden"/>
    <input id="seo_type" name="seo[schema][seo_type]" value="FAQPage" class="hidden"  type="hidden"/>
    <div id="schema-question-section">
        @foreach($schema['faq'] ?? [] as $faq)
                <div class="faqItem" id="faqItem-{{$loop->index}}">
                    <div class="mb-3 flex justify-between items-center gap-6">
                        <div class="w-full">
                            <x-main::input.label value="{{__('question')}}" for="question-{{$loop->index}}"/>
                            <x-main::input.text id="question-{{$loop->index}}" class="block w-full" type="text" name="seo[schema][faq][{{$loop->index}}][question]"
                                          :value="$faq['question'] ?? '' "/>
                            <x-main::input.error :messages="$errors->get('seo.schema.faq.'.$loop->index.'question')" class="mt-2"/>
                        </div>
                        <div>
                            <button role="button" type="button" class="text-red-900 deleteItemBtn"
                                    target="faqItem-{{$loop->index}}" onclick="document.getElementById('faqItem-{{$loop->index}}').remove()">&times;
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <x-main::input.label for="answer-{{$loop->index}}" value="{{__('answer')}}"/>
                        <x-main::input.textarea id="answer-{{$loop->index}}" class="block w-full"
                                          name="seo[schema][faq][{{$loop->index}}][answer]" >{{$faq['answer'] ?? ''}}</x-main::input.textarea>
                        <x-main::input.error :messages="$errors->get('seo.schema.faq.'.$loop->index.'answer')" class="mt-2"/>

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
              txt1: '',
              txt2: ''
           });
        },
        removeField(index) {
           this.fields.splice(index, 1);
         }
      }
      }">
        <div>
            <template x-data="{'lngth' : document.querySelectorAll('.faqItem').length}"
                      x-for="(field, index) in fields" :key="index">
                <div class="faqItem" x-bind:id="`faqItem-${index + lngth + 1}`">
                    <div class="mb-3 flex justify-between items-center gap-6">
                        <div class="w-full">
                            <x-main::input.label value="{{__('question')}}" x-bind:for="`question-${index + lngth + 1}`"/>
                            <x-main::input.text x-bind:id="`question-${index + lngth + 1}`" class="block w-full"
                                          x-model="field.txt1" type="text" x-bind:name="`seo[schema][faq][${index + lngth + 1}][question]`"
                                          maxlength="255"/>
                        </div>
                        <div>
                            <button type="button" class="text-red-900" @click="removeField(index)">
                                &times;
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <x-main::input.label x-bind:for="`answer-${index + lngth + 1}`" value="{{__('answer')}}"/>
                        <x-main::input.textarea x-bind:id="`answer-${index + lngth + 1}`" class="block w-full"
                                          x-model="field.txt2" x-bind:name="`seo[schema][faq][${index + lngth + 1}][answer]`"></x-main::input.textarea>

                    </div>

                </div>
            </template>
            <div>
                <x-main::button.primary type="button" role="button" title="{{__('add question')}}" id="addQuestion"
                                  @click="addNewField()">
                    {{__('add')}}
                </x-main::button.primary>

            </div>
        </div>
    </div>
</section>
