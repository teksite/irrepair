<section>
    <div id="schema-name-section">

        @foreach($instance->rules ?? [] as $rule)
            <div class="ruleItem" id="ruleItem-{{$loop->index}}">
                <div class="mb-3 flex justify-between items-center gap-6">
                    <div class="w-full">
                        <x-main::input.label value="{{__('name')}}" for="name-{{$loop->index}}"/>
                        <x-main::input.text id="name-{{$loop->index}}" class="block w-full" type="text" name="rules[{{$loop->index}}][name]" :value="$rule['name'] ?? '' "/>
                        <x-main::input.error :messages="$errors->get('rules.'.$loop->index.'name')" class="mt-2"/>
                    </div>
                    <div class="w-full">
                        <x-main::input.label for="rule-{{$loop->index}}" value="{{__('rule')}}"/>
                        <x-main::input.text id="name-{{$loop->index}}" class="block w-full" type="text" name="rules[{{$loop->index}}][rule]" :value="$rule['rule'] ?? '' " dir="ltr" />
                        <x-main::input.error :messages="$errors->get('rules.'.$loop->index.'rule')" class="mt-2"/>

                    </div>
                    <div>
                        <button role="button" type="button" class="text-red-900 deleteItemBtn"
                                target="ruleItem-{{$loop->index}}" onclick="document.getElementById('ruleItem-{{$loop->index}}').remove()">&times;
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
            <template x-data="{'lngth' : document.querySelectorAll('.ruleItem').length}" x-for="(field, index) in fields" :key="index">
                <div class="ruleItem" x-bind:id="`ruleItem-${index + lngth + 1}`">
                    <div class="mb-3 flex justify-between items-center gap-6">
                        <div class="w-full">
                            <x-main::input.label value="{{__('name')}}" x-bind:for="`name-${index + lngth + 1}`"/>
                            <x-main::input.text x-bind:id="`name-${index + lngth + 1}`" class="block w-full"
                                                x-model="field.txt1" type="text" x-bind:name="`rules[${index + lngth + 1}][name]`"
                                                maxlength="255"/>
                        </div>
                        <div class="w-full">
                            <x-main::input.label x-bind:for="`rule-${index + lngth + 1}`" value="{{__('rule')}}"/>
                            <x-main::input.text x-bind:id="`rule-${index + lngth + 1}`" class="block w-full"
                                                x-model="field.txt2" type="text" x-bind:name="`rules[${index + lngth + 1}][rule]`" dir="ltr"/>
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
                <x-main::button.primary type="button" role="button" title="{{__('add name')}}" id="addQuestion"
                                        @click="addNewField()">
                    {{__('add')}}
                </x-main::button.primary>

            </div>
        </div>
    </div>
</section>
