@php($random = rand(100, 999))
<div class="w-full">
    <input type="hidden" name="address" class="hidden w-full" value="{{request()->url()}}" readonly>
    <input type="hidden" name="title" class="hidden w-full" readonly>
    <x-input.text pattern="[0-9]{11}" aria-label="phone" id="name_{{$random}}" inputmode="tel" class="block w-full" type="tel" name="phone" :value="old('phone')" required autocomplete="phone" placeholder="{{__('cellphone number')}}"/>
    <x-input.error :messages="$errors->get('phone')" class="mt-2"/>
</div>
