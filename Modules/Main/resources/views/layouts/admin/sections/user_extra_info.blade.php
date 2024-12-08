<div>
    <h2 class="mb-3">
        {{__('extra information')}}
    </h2>
    <p>
        {{__('by checking each of the below data, they will be shown in user\'s profile')}}.
    </p>

    <div class="my-3 lg:w-1/2">
        <div class="flex items-center gap-3 mb-2">
            <x-main::input.label for="codeـmeli" value="{{__('code meli')}}" class="!mb-0"/>
            <span class="text-red-700 text-xs">
                                ( {{__('code meli is not shown at all')}} )
                         </span>

        </div>
        <x-main::input.text id="codeـmeli" class="block mt-1 w-full" type="number" name="code_meli" :value="old('code_meli')?? $user->code_meli" />
    </div>

    <div class="grid gap-6 md:grid-cols-2 mb-6">
        <x-main::input.error :messages="$errors->get('meta')" class="mt-2"/>
        @foreach(config('sitesetting.user_social_items')   as $item)
            @php($random='extra-'.rand(1000,9999))
            <div class="">

                <div class="flex items-center gap-3">
                    <x-main::input.checkbox name="meta[social][{{$item}}][status]" :checked="old('meta.social.'.$item.'.status') || (isset($instance[$item]['status']) && $instance[$item]['status']=='on') "/>
                    <x-main::input.label for="{{$random}}" value="{{__($item)}}"/>
                </div>
                <x-main::input.text id="{{$random}}" class="block mt-1 w-full" type="text" name="meta[social][{{$item}}][value]"  :value="old('meta.social.'.$item.'.value') ?? $instance[$item]['value'] ?? ''"/>

                <x-main::input.error :messages="$errors->get('meta.social'.$item.'.status')" class="mt-2"/>
                <x-main::input.error :messages="$errors->get('meta.social'.$item.'.value')" class="mt-2"/>
                <x-main::input.error :messages="$errors->get('meta.social'.$item)" class="mt-2"/>
                <x-main::input.error :messages="$errors->get('meta.social')" class="mt-2"/>
            </div>
        @endforeach
    </div>

</div>
