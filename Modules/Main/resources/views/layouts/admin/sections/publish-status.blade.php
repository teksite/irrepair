@props(['date'=>true])
<div>
    <x-main::accordion.single :title="__('publish status')" :open="$open">
        <x-main::input.select id="publish-status" class="block mt-1 w-full"  name="status" aria-label="{{__('publish status')}}">
            @foreach(\Modules\Main\Enums\PublishStatusEnum::cases() as $case)
                <option {{isset($instance) && $instance->status->value == $case->value ? 'selected' : ''}}
                        value="{{$case->value}}">{{__($case->value)}}</option>
            @endforeach
        </x-main::input.select>
        @if($date)
            <div id="publishAtSec" class="mt-6">
                <x-main::input.label for="publishAtInput" :value="__('published at')"/>
                <x-main::input.time id="publishAtInput"  type="datetime-local" name="published_at" :value="old('published_at') ?? $instance->published_at ?? ''" class="block w-full"/>

            </div>
         @endif

    </x-main::accordion.single>
    <x-main::input.error :messages="$errors->get('status')" class="mt-2"/>
    <x-main::input.error :messages="$errors->get('published_at')" class="mt-2"/>


</div>
