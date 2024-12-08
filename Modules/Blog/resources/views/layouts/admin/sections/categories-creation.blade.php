<x-main::accordion.single :title="$title" :open="$open">
    <x-main::input.select id="parent_id" type="text" name="parent_id" class="block mt-1 w-full">
        <option value="0" {{old('parent_id') == 0  ? 'selected':''}} >
           {{__('as parent')}}
        </option>
        @if($categories->count())
            @foreach($categories as $cat)
                @if(isset($instance) && ($instance->id == $cat->id || in_array($cat->id,$instance->descendants->pluck('id')->toArray()))
                    || $cat->label=='uncategorized-category')
                    @continue
                @endif
                <option
                    class="{{$cat->parent_id =='0' ? 'font-bold' :''}}"
                    value="{{$cat->id}}" {{isset($instance) && $instance->parent_id == $cat->id ? 'selected':''}} >
                    {{$cat->title}}
                </option>
            @endforeach
        @endif
    </x-main::input.select>
    <x-main::input.error :messages="$errors->get('parent_id')" class="mt-2"/>

</x-main::accordion.single>

