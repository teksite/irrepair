@props(['multiple'=>false ,'open'=>'false'])
<div>
    <x-main::accordion.single :title="__('permissions')" open="{{$open}}">
        <x-main::input.select name="permissions[]" id="permissionsSelection" class="block w-full" :multiple="$multiple" aria-label="{{__('permissions')}}">
            @foreach(cache()->get('allPermissions') ?? \Modules\Main\Models\Permission::query()->select(['id','title'])->get() ?? [] as $permission)
                <option value="{{$permission->id}}" {{isset($instance) && in_array($permission->id, $instance->permissions->pluck(['id'])->toArray()) ? 'selected' : ''}}>
                    {{$permission->title}}
                </option>
            @endforeach
        </x-main::input.select>
    </x-main::accordion.single>
    <x-main::input.error :messages="$errors->get('permissions')" class="mt-2"/>
    <x-main::input.error :messages="$errors->get('permissions.*')" class="mt-2"/>
</div>
