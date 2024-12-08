@props(['open'=>true])
@php
    if(isset($instance)){
        $relativesUsers=$instance?->relatedUsers  ?? collect([]);
    }
@endphp
<x-main::accordion.single :title="__('related users')" :open="$open">
    <div class="my-3">
        <x-main::input.select id="relative_users" :multiple="true" class="block mt-1 w-full" name="relative_users[]">
            @isset($relativesUsers)
                @foreach($relativesUsers as $related)
                    <option value="{{$related->id}}" selected>{{$related->name}}</option>
                @endforeach
            @endisset
        </x-main::input.select>
        <x-main::input.error :messages="$errors->get('relative_users')" class="mt-2"/>
    </div>
</x-main::accordion.single>
