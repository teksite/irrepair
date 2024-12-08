
<section>
    <input id="seo_type" name="seo[meta][seo_type]" value="CollectionPage" class="hidden"  type="hidden"/>
    <input id="seo_type" name="seo[schema][seo_type]" value="CollectionPage" class="hidden"  type="hidden"/>
    <div class="mb-3">
        <x-main::input.label value="{{__('name')}}" for="schema_name"/>
        <x-main::input.text id="schema_name" name="schema[name]" class="block w-full mb-3"
                      value="{{old('schema.name') ?? $schema['name'] ?? ''}}"/>
        <x-main::input.error :messages="$errors->get('schema.name')"/>
    </div>
    <div class="mb-3">
        <x-main::input.label value="{{__('schema description')}}" for="schema_description"/>
        <x-main::input.textarea id="schema_description" name="schema[description]"
                          class="block w-full mb-3">{{old('schema.description') ?? $schema['description'] ?? ''}}</x-main::input.textarea>
        <x-main::input.error :messages="$errors->get('schema.description')"/>
        <p class="text-xs text-gray-700">
            {{__('leave it empty to read from meta description')}}
        </p>
    </div>

    <div class="mb-3">
        <x-main::input.label value="{{__('items type')}}" for="items_type"/>
        <x-main::input.select id="items_type" name="schema[itemsType]" class="block w-full mb-3">
            <option value="CreativeWork">CreativeWork</option>
            <option value="ListItem">ListItem</option>

        </x-main::input.select>
        <x-main::input.error :messages="$errors->get('schema.itemsType')"/>
        <p class="text-xs text-gray-700">
            {{__('leave it empty to read from meta description')}}
        </p>
    </div>

</section>
