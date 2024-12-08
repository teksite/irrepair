<x-main::accordion.single :title="__('confirmation')" :open="$open">
    <section>
        <x-main::input.select id="publish-status" class="block mt-1 w-full" name="confirmed">
                <option  {{isset($instance) && !$instance->confirmed ? 'selected' : ''}} value="0">
                    {{__('unconfirmed')}}
                </option>
            <option  value="1" {{isset($instance) && $instance->confirmed ? 'selected' : ''}} value="1">
                {{__('confirmed')}}
            </option>
        </x-main::input.select>
        <x-main::input.error :messages="$errors->get('confirmed')" class="mt-2"/>
    </section>
</x-main::accordion.single>
