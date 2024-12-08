@props(['open'=>true])
@php
    if(!cache()->has('allCustomers')){
               cache()->put('allCustomers',\Modules\Customer\Models\Customer::all(), now()->addMonths(6));
           }
   $customers=cache()->get('allCustomers');

   $oldCustomers=old('customers') ?? \Modules\Theme\Models\ThemeSetting::query()->where('key','homepage_customers')->first()?->value->toArray() ?? [];

@endphp

<x-main::accordion-editor :title="__('customers')" :open="$open">
    <section>
        <x-main::input.label :value="__('description')" for="customers-description"/>
        <x-main::input.textarea id="customers-description" class="block w-full"  name="customers[description]">{!! $oldCustomers['description'] ?? '' !!}</x-main::input.textarea>
        <x-main::input.error :messages="$errors->get('customers')" class="mt-2"/>
    </section>
    <section>
        <x-main::input.label :value="__('items')" for="customers-item"/>
        <x-main::input.select id="customers-item" class="block w-full select-box" :multiple="true" name="customers[item][]">
            @foreach($customers as $customer)
                <option value="{{$customer->id}}"
                    {{in_array($customer->id , $oldCustomers['item'] ?? []) ? 'selected' :''}} >
                    {{$customer->title}}
                </option>
            @endforeach
        </x-main::input.select>
        <x-main::input.error :messages="$errors->get('customers')" class="mt-2"/>
    </section>
</x-main::accordion-editor>
