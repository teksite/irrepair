<section>
    <input id="seo_type" name="seo[meta][seo_type]" value="Blog" class="hidden"  type="hidden"/>
    <input id="seo_type" name="seo[schema][seo_type]" value="Blog" class="hidden"  type="hidden"/>
    <div class="mb-3">
        <x-main::input.label value="{{__('title')}}" for="title"/>
        <x-main::input.text id="title" name="seo[schema][title]" class="block w-full mb-3"
                      value="{{old('seo.schema.title') ?? $schema['title'] ?? ''}}"/>
        <x-main::input.error :messages="$errors->get('seo.schema.title')"/>
    </div>
    <div class="mb-3 ">
        <x-main::input.label value="{{__('schema description')}}" for="schema_description"/>
        <x-main::input.textarea id="schema_description" name="seo[schema][description]"
                          class="block w-full mb-3">{{old('seo.schema.description') ?? $schema['description'] ?? ''}}</x-main::input.textarea>
        <x-main::input.error :messages="$errors->get('seo.schema.description')"/>
    </div>

</section>
