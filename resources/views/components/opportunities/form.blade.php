<div>
   <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'open-send-cv')" aria-controls="open-send-cv" type="button"
                class="send-cv-btn text-primary-900 hover:bg-primary-900 hover:text-gray-200 px-3 py-1 rounded-lg border border-primary-900"
                title="{{__('send your resume')}}">
            {{__('send your resume')}}
        </button>
   <x-modal name="open-send-cv" focusable>
            <div class="p-6" id="ModalCV">
                <div class="flex justify-between item" id="">
                    <div class="flex gap-3 items-center justify-start">
                        <img src="{{'/uploads/logo/logo.png'}}" alt="{{__('employment in :title',['title'=>__(config('app.name'))])}}" loading="lazy" fetchPriority="low" decoding="async" height="75" width="75">
                        <h3 id="modalTitle" class="!mb-0">
                            {{__('send your resume')}}
                        </h3>
                    </div>
                    <button title="{{__('close')}}" role="button" type="button" @click="show=false">
                        <i class="tkicon fill-none stroke-red-600" size="18" data-icon="cross"></i>
                    </button>
                </div>
                <hr class="my-3">
                <div id="modal-description" class="">
                    <form action="{{route('occupations.demand.store')}}" method="POST" enctype="multipart/form-data"
                          class="form collect-data-form ">
                        @csrf
                        <input type="hidden" class="input hidden" name="formpot">

                        <div class="mb-6 grid gap-6 lg:grid-cols-2 ">
                            <div class="">
                                <div class="mb-6">
                                    <x-input.label for="name" :value="__('name')"/>
                                    <x-input.text id="name" class="block w-full" type="text" name="name" :value="old('name')" required autocomplete="name" placeholder="{{__('full name')}}"/>
                                    <x-input.error :messages="$errors->get('name')" class="mt-2"/>
                                </div>
                                <div class="mb-6">
                                    <x-input.label for="email" :value="__('email')"/>
                                    <x-input.text id="email" class="block w-full" type="email" name="email" :value="old('email')" dir="ltr" required autocomplete="email" inputmode="email" placeholder="example@example.com"/>
                                    <x-input.error :messages="$errors->get('email')" class="mt-2"/>
                                </div>
                                <div class="mb-6">
                                    <x-input.label for="phone" :value="__('phone')"/>
                                    <x-input.text id="phone" class="block w-full" type="tel" name="phone" :value="old('phone')" required dir="ltr" autocomplete="tel" inputmode="tel" placeholder="09XXXXXXXXX"/>
                                    <x-input.error :messages="$errors->get('phone')" class="mt-2"/>
                                </div>
                                <div class="mb-6">
                                    <x-input.label for="opportunity" :value="__('active opportunities')"/>
                                    <x-input.select id="opportunity" class="block w-full" name="opportunity" required>
                                        @foreach($instance as $opportunity)
                                            @if($opportunity->status->value !=='published')
                                                @continue
                                            @endif
                                            <option value="{{$opportunity->id}}">{{$opportunity->title}}</option>
                                        @endforeach
                                    </x-input.select>
                                    <x-input.error :messages="$errors->get('opportunity')" class="mt-2"/>
                                </div>
                            </div>
                            <div class="w-full max-w-md mb-6">
                                    <span class="h5">
                                        {{__('upload your resume')}}
                                    </span>
                                    <span class="text-xs text-blue-600 block my-3">فقط فرمت PDF با حجم کمتر 3MB قابل قبول است.</span>
                                    <x-input.file-drag accept="application/pdf" name="file" data-id="send-cv"/>
                                    <x-input.error :messages="$errors->get('file')" class="mt-2"/>
                                </div>
                            <div class="mb-3 flex items-center gap-6">
                                <x-main::input.label class="min-w-fit" :value="__('captcha code')" for="captcha-code"/>
                                <div class="mb-3 w-full">
                                    <x-captcha::load/>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <x-button.primary type="submit" role="button" title="{{__('submit')}}">
                                {{__('send')}}
                            </x-button.primary>

                        </div>
                    </form>
                </div>
            </div>
        </x-modal>

    <x-input.error :messages="$errors->get('name')" class="mt-2"/>
    <x-input.error :messages="$errors->get('email')" class="mt-2"/>
    <x-input.error :messages="$errors->get('opportunity')" class="mt-2"/>
    <x-input.error :messages="$errors->get('phone')" class="mt-2"/>
    <x-input.error :messages="$errors->get('file')" class="mt-2"/>
    <x-input.error :messages="$errors->get('g-recaptcha-response')" class="mt-2"/>

</div>


