@props(['open'=>true ,'path'])

@php
    $templates=[];
    $directory = base_path($path);
    $bladeFiles =  \Illuminate\Support\Facades\File::glob($directory . '/*.blade.php');
    foreach ($bladeFiles as $bladeFile) {
        $fileName = pathinfo($bladeFile, PATHINFO_FILENAME);
        $templates[]= $variable = substr($fileName, 0, strpos($fileName, ".blade"));
    }
@endphp
<div>
    <x-main::accordion.single :title="__('template')" :open="$open">
        <x-main::input.select id="templates" class="block w-full" name="template">
            <option
                value="" {{old('template')==null || isset($instance) && $instance->template == null ? 'selected' : ''}}>
                {{__('default')}}
            </option>
            @if(count($templates))
                @foreach($templates as $template)
                    <option value="{{$template}}" @selected( isset($instance) && $instance->template == $template)  >
                        {{$template}}
                    </option>
                @endforeach
            @endif
        </x-main::input.select>
    </x-main::accordion.single>
    <x-main::input.error :messages="$errors->get('template')" class="mt-2"/>
</div>
