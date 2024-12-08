
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 mb-6">
        <div>
            <x-input.label for="name" :value="__('name and lastname')"/>
            <x-input.text id="name" class="block w-full" type="text" name="name" :value="old('name')" required autocomplete="name" placeholder="{{__('full name')}}"/>
            <x-input.error :messages="$errors->get('name')" class="mt-2"/>

        </div>
        <div>
            <x-input.label for="email" :value="__('email')"/>
            <x-input.text id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="email" inputmode="email" placeholder="example@example.com"/>
            <x-input.error :messages="$errors->get('email')" class="mt-2"/>
        </div>

    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 mb-6">
        <div>
            <x-input.label for="telephone" :value="__('telephone')"/>
            <x-input.text id="telephone" class="block w-full" type="text" name="telephone" :value="old('telephone')" required autocomplete="tel" inputmode="tel" placeholder="09XXXXXXXXX"/>
            <x-input.error :messages="$errors->get('telephone')" class="mt-2"/>

        </div>
        <div>
            <x-input.label for="phone" :value="__('phone')"/>
            <x-input.text id="phone" class="block w-full" type="text" name="phone" :value="old('phone')" required autocomplete="tel" inputmode="tel" placeholder="021XXXXXXXX"/>
            <x-input.error :messages="$errors->get('phone')" class="mt-2"/>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 mb-6">
        <div>
            <x-input.label for="company" :value="__('company name')"/>
            <x-input.text id="company" class="block w-full" type="text" name="company" :value="old('company')" required autocomplete="organization" placeholder="{{__('company name')}}"/>
            <x-input.error :messages="$errors->get('company')" class="mt-2"/>
        </div>
        <div>
            <x-input.label for="position" :value="__('organizational position')"/>
            <x-input.text id="position" class="block w-full" type="text" name="position" :value="old('position')" placeholder="{{__('organizational position')}}"/>
            <x-input.error :messages="$errors->get('position')" class="mt-2"/>
        </div>
    </div>
    <div class="mb-6">
        <x-input.label for="message" :value="__('message')"/>
        <x-input.textarea id="message" class="block mt-1 w-full" rows="6" max="512"
                          name="message" autocomplete="off" required placeholder="{{__('your message')}}">{{old('message')}}</x-input.textarea>
        <x-input.error :messages="$errors->get('message')" class="mt-2"/>
    </div>

