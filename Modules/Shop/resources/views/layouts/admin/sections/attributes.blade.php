@props(['open'=>true])
<x-main::accordion.single :title="__('attribute')" :open="$open">
    <section>

        @foreach(\Modules\Shop\Models\Attribute::query()->select(['id','title'])->with('values')->get() as $attr)
            <div class="grid md:grid-cols-2 gap-6 items-center p-3 border border-slate-200 rounded-lg mb-3">
                <div>
                    <p>
                        {{$attr->title}}
                    </p>
                </div>
                <div>
                    <x-main::input.label :value="__('values')" for="attr-{{$attr->id}}"/>

                    <x-main::input.select class="block w-full" id="attribute-{{$attr->id}}" name="attributes[{{$attr->id}}][]">
                        <option value="">
                            {{__('none')}}
                        </option>
                        @foreach($attr->values as $val)
                            <option value="{{$val->id}}" {{isset($instance) &&  in_array( $val->id ,$instance->productAttributes->pluck('pivot.value_id')->unique()->toArray()) ? 'selected' :''}}>
                                {{$val->value}}
                            </option>
                        @endforeach
                    </x-main::input.select>
                </div>

            </div>
        @endforeach

        <x-main::input.error :messages="$errors->get('attribute')" class="mt-2"/>

    </section>
</x-main::accordion.single>
