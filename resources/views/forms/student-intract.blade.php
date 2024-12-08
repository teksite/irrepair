<x-form::layout id="4">
    <div class="grid gap-6 md:grid-cols-2">
        <div class="mb-6">
            <x-input.label for="name" :value="__('name')"/>
            <x-input.text id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" placeholder="{{__('name')}}"/>
            <x-input.error :messages="$errors->get('name')" class="mt-2"/>
        </div>
        <div class="mb-6">
            <x-input.label for="family" :value="__('family name')"/>
            <x-input.text id="family" class="block mt-1 w-full" type="text" name="family" :value="old('family')" required autocomplete="family" placeholder="{{__('family name')}}"/>
            <x-input.error :messages="$errors->get('family')" class="mt-2"/>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">

        <div class="mb-6">
            <x-input.label for="code_meli" :value="__('code meli')"/>
            <x-input.text id="code_meli" class="block mt-1 w-full" type="code_meli" name="code_meli" :value="old('code_meli')" required/>
            <x-input.error :messages="$errors->get('code_meli')" class="mt-2"/>
        </div>

        <div class="mb-6">
            <x-input.label for="phone" :value="__('phone')"/>
            <x-input.text id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" inputmode="tel" placeholder="09XXXXXXXXX"/>
            <x-input.error :messages="$errors->get('phone')" class="mt-2"/>
        </div>

    </div>
    <div class="mb-6">
        <x-input.label for="email" :value="__('email')"/>
        <x-input.text id="email" class="block mt-1 w-full" type="tel" name="email" :value="old('email')" required autocomplete="email" inputmode="email" placeholder="example@example.ir"/>
        <x-input.error :messages="$errors->get('phone')" class="mt-2"/>
    </div>
    <div class="grid gap-6 md:grid-cols-2">

        <div class="mb-6">
            <x-input.label for="university" :value="__('university')"/>
            <x-input.text id="university" class="block mt-1 w-full" type="university" name="university" :value="old('university')" required autocomplete="university"/>
            <x-input.error :messages="$errors->get('university')" class="mt-2"/>
        </div>

        <div class="mb-6">
            <x-input.label for="study field" :value="__('study field')"/>
            <x-input.text id="study field" class="block mt-1 w-full" type="tel" name="field" :value="old('field')" required/>
            <x-input.error :messages="$errors->get('field')" class="mt-2"/>
        </div>
    </div>

</x-form::layout>
