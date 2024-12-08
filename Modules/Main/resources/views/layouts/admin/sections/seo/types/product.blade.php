
<section>
    <input id="seo_type" name="seo[meta][seo_type]" value="Product" class="hidden"  type="hidden"/>
    <input id="seo_type" name="seo[schema][seo_type]" value="Product" class="hidden"  type="hidden"/>

    <div class="mb-3 grid gap-3 md:grid-cols-2">
        <div>
            <x-main::input.label value="{{__('name')}}" for="schema_name"/>
            <x-main::input.text id="schema_name" name="seo[schema][name]" class="block w-full mb-3"
                          value="{{old('seo.schema.name') ?? $schema['name'] ?? $schema['title']  ?? ''}}"/>
            <x-main::input.error :messages="$errors->get('seo.schema.name')"/>
        </div>
    </div>
    <div class="mb-3 ">
        <x-main::input.label value="{{__('schema description')}}" for="schema_description"/>
        <x-main::input.textarea id="schema_description" name="seo[schema][description]"
                          class="block w-full mb-3">{{old('seo.schema.description') ?? $schema['description'] ?? ''}}</x-main::input.textarea>
        <x-main::input.error :messages="$errors->get('seo.schema.description')"/>
    </div>
    <div class="mb-3 grid gap-3 md:grid-cols-2">
        <div>
            <x-main::input.label value="{{__('image url')}}" for="schema_imageUrl"/>
            <x-main::input.text id="schema_imageUrl" name="seo[schema][imageUrl]" dir="ltr" type="url"
                          value="{{old('seo.schema.imageUrl') ?? $schema['imageUrl'] ?? ''}}"
                          class="block w-full mb-3"/>
            <x-main::input.error :messages="$errors->get('seo.schema.imageUrl')"/>
                   </div>
    </div>
    <div>
        <h4 class="text-gray-600 text-bold mb-3">{{__('id properties')}}</h4>
        <div class="mb-3 grid gap-3 md:grid-cols-2 lg:grid-cols-3">
            <div>
                <x-main::input.label value="{{__('sku')}}" for="sku"/>
                <x-main::input.text id="sku" name="seo[schema][sku]"
                              value="{{old('seo.schema.sku') ?? $schema['sku'] ?? ''}}"
                              class="block w-full mb-3"/>
                <x-main::input.error :messages="$errors->get('seo.schema.sku')"/>
            </div>
            <div>
                <x-main::input.label value="{{__('gtin8')}}" for="gtin8"/>
                <x-main::input.text id="sku" name="seo[schema][gtin8]"
                              value="{{old('seo.schema.gtin8') ?? $schema['gtin8'] ?? ''}}"
                              class="block w-full mb-3"/>
                <x-main::input.error :messages="$errors->get('seo.schema.gtin8')"/>
            </div>
            <div>
                <x-main::input.label value="{{__('gtin13')}}" for="gtin13"/>
                <x-main::input.text id="sku" name="seo[schema][gtin13]"
                              value="{{old('seo.schema.gtin13') ?? $schema['gtin13'] ?? ''}}"
                              class="block w-full mb-3"/>
                <x-main::input.error :messages="$errors->get('seo.schema.gtin13')"/>
            </div>
            <div>
                <x-main::input.label value="{{__('gtin14')}}" for="gtin14"/>
                <x-main::input.text id="sku" name="seo[schema][gtin14]"
                              value="{{old('seo.schema.gtin14') ?? $schema['gtin14'] ?? ''}}"
                              class="block w-full mb-3"/>
                <x-main::input.error :messages="$errors->get('seo.schema.gtin14')"/>
            </div>
            <div>
                <x-main::input.label value="{{__('mpn')}}" for="mpn"/>
                <x-main::input.text id="sku" name="seo[schema][mpn]"
                              value="{{old('seo.schema.mpn') ?? $schema['mpn'] ?? ''}}"
                              class="block w-full mb-3"/>
                <x-main::input.error :messages="$errors->get('seo.schema.mpn')"/>
            </div>
        </div>
    </div>

</section>
