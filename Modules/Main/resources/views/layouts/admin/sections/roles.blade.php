@props(['multiple'=>false ,'open'=>'false'])
@php
$minCurrentRole=auth()->user()->roles()->min('hierarchy');
@endphp

<div>
    <x-main::accordion.single :title="__('roles')" open="{{$open}}">
        <x-main::input.select name="roles[]" id="rolesSelection" class="block w-full" :multiple="$multiple" aria-label="{{__('roles')}}">
            @foreach(cache()->get('allRoles') ?? \Modules\Main\Models\Role::query()->select(['id','title','hierarchy'])->get() ?? [] as $role)
                @if($minCurrentRole <= $role->hierarchy)
                <option
                    value="{{$role->id}}" {{isset($instance) && in_array($role->id, $instance->roles->pluck(['id'])->toArray()) ? 'selected' : ''}}>
                    {{$role->title}}
                </option>
                @endif
            @endforeach
        </x-main::input.select>
    </x-main::accordion.single>
    <x-main::input.error :messages="$errors->get('permissions')" class="mt-2"/>
    <x-main::input.error :messages="$errors->get('permissions.*')" class="mt-2"/>
</div>
