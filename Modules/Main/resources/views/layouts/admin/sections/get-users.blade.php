@php use App\Models\User; @endphp
@props(['open'=>true ,'multiple'=>false,'name','label' ,'selected'=>[]])
@php
    $random=\Illuminate\Support\Str::random(3).rand(10,1000);
    $data=old($name) ??  $instance?->getMeta($name)  ?? $selected ?? [];
    $items=User::query()->whereIn('id',$data)->select(['id' ,'name'])->get();
@endphp
<x-main::accordion.single :title="$label" :open="$open">
    <x-main::input.select :multiple="$multiple" id="model_id_{{$random}}" class="block w-full get-by-ajax border-none !py-0 !px-0" name="{{$name}}"
                          data-value-field="id" data-label-field="name"
                          data-search-field="name" data-url="{{route('admin.ajax.users.get')}}">
        @foreach($items as $item)
            <option value="{{$item->id ?? $item['id']}}" selected>{{$item->name ?? $item['name']}}</option>
        @endforeach
    </x-main::input.select>
    <x-main::input.error :messages="$errors->get($name)" class="mt-2"/>
</x-main::accordion.single>
