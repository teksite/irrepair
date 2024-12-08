<form action="{{route('newsletters.store')}}" method="POST" class="form collect-data-form">
    @csrf
    <div class="flex items-center gap-3">
        <x-input.label value="{{__('newsletter')}}" for="newsletter-email" class="!text-gray-200 !mb-0 "/>
        <div class="w-full flex items-stretch">
            <x-input.text name="mail" placeholder="{{__('your email address')}}" id="newsletter-email" autocomplete="off" class="block w-full rounded-e-none !bg-gray-50"/>
            <button type="submit" class="flex items-center justify-center p-1 bg-white rounded-e-lg text-sm p" title="{{__('submit')}}">
                {{__('membership')}}</button>
        </div>
    </div>
    <x-input.error :messages="$errors->get('mail')" class="mt-2"/>
    <div class="response"></div>
</form>
