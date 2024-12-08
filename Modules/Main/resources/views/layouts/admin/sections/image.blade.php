@props(['type' =>'image' ,'placeholder'=>'image' ,'name'=>'featured_image' ,'column'=>'featured_image','label'=>null])
@once
    @push('footerScripts')
        <script>
            let inputId = '';

            document.addEventListener("DOMContentLoaded", function () {

                let imageBtnEls = document.querySelectorAll('.button-image')
                imageBtnEls.forEach(imageBtnEl => {
                    imageBtnEl.addEventListener('click', e => {
                        e.preventDefault();
                        inputId = imageBtnEl.getAttribute('data-for');
                        window.open('{{route('fm.fm-button')}}', 'fm', 'width=1200,height=800');
                    });
                });
            });
            function fmSetLink($url) {
                if (inputId !== 'gallery_type') {
                    document.getElementById(`${inputId}-input`).value = $url;
                    document.getElementById(`${inputId}-preview`).setAttribute('src', $url);
                } else {
                    let divElement = document.createElement('div')
                    divElement.classList.add('gallery-item')

                    let input = document.createElement('input')
                    input.setAttribute('type', 'hidden');
                    input.setAttribute('value', $url);
                    input.setAttribute('name', 'gallery[]');

                    let deleteBtn = document.createElement('button')
                    deleteBtn.setAttribute('onclick', "deleteGalleryItem(event)")
                    deleteBtn.setAttribute('type', "button")
                    deleteBtn.setAttribute('class', "text-red-700")
                    deleteBtn.innerText = 'delete'

                    let imgElement = document.createElement('img')
                    imgElement.setAttribute('width', '70');
                    imgElement.setAttribute('height', '70');
                    imgElement.setAttribute('class', 'w-full');
                    imgElement.setAttribute('src', $url);

                    divElement.append(imgElement, input, deleteBtn)

                    document.getElementById('gallery_preview').append(divElement);
                }
            }


            let imageDeleteBtnEls = document.querySelectorAll('.image-delete-btn')
            if (imageDeleteBtnEls.length) {
                imageDeleteBtnEls.forEach(imageDeleteBtn => {
                    imageDeleteBtn.addEventListener('click', event => {
                        event.preventDefault();
                        let uniqueId = imageDeleteBtn.getAttribute('data-for');
                        document.getElementById(`${uniqueId}-input`).value = '';
                        let previewEl = document.getElementById(`${uniqueId}-preview`);
                        previewEl.src = previewEl.getAttribute('placeholder');
                    })
                })
            }
            let inputImageEls = document.querySelectorAll('.input-image')
            if (inputImageEls.length) {
                inputImageEls.forEach(inputImageEl => {
                    inputImageEl.addEventListener('change', () => {
                        let uniqueId = inputImageEl.getAttribute('data-for');
                        if (inputImageEl.value.length > 0) {
                            document.getElementById(`${uniqueId}-preview`).src = inputImageEl.value;
                        } else {
                            let previewEl = document.getElementById(`${uniqueId}-preview`);
                            previewEl.src = previewEl.getAttribute('placeholder');

                        }
                    })
                })
            }

            function deleteGalleryItem(event) {
                event.preventDefault();
                let del = event.target;
                del.parentElement.remove();
            }

        </script>

    @endpush
@endonce
@php
    $random=\Illuminate\Support\Str::random(8).rand(10,100);
        if($placeholder == 'profile'){
        $placeholderImage=asset('/admin/images/no-profile.jpg');
        }else{
        $placeholderImage=asset('/admin/images/no-cover.jpg');
        }
@endphp
<x-main::accordion.single :title="$title" :open="$open">
    @if($type == 'image')
        <section class="mb-3 w-full">
            @if($label)
                <x-main::input.label :value="__($label)"/>
            @endif
            <div class="relative">
                <img width="250" height="140" class="block w-full" id="{{$random}}-preview" alt="" placeholder="{{$placeholderImage}}"
                     src="{{old($name) ?? $instance->$name ?? $placeholderImage ?? '' }}">

                <button type="button" title="{{__('delete featured image')}}" data-for="{{$random}}"
                        class="text-red-700 right-0-0 top-0 absolute image-delete-btn">
                    {{__('delete')}}
                </button>

            </div>

            <x-main::input.text type="text" class="block mb-3 w-full input-image" dir="ltr" id="{{$random}}-input"
                                :value="old($name) ?? $instance->$column ?? '' " data-for="{{$random}}" name="{{$name ?? 'featured_image'}}"/>

            <x-main::button.hollow-primary type="button" class="w-full !block text-center button-image" data-for="{{$random}}">
                {{__('choose')}}
            </x-main::button.hollow-primary>

            <x-main::input.error :messages="$errors->get($name)" class="mt-2"/>
        </section>
    @elseif($type == 'gallery')
        <section class="my-3">
            @if($label)
                <x-main::input.label :value="__($label)"/>
            @endif
            <div id="gallery_preview" class="grid gap-3 grid-cols-2 md:grid-cols-4">
                @php
                    if(isset($instance->gallery)){
                                $items = old('gallery') ?? json_decode($instance->gallery) ?? null;
                      }else{
                        $items = old('gallery')  ?? null;
                        }
                @endphp
                @if(!is_null($items))
                    @foreach($items as $item)
                        <div class="gallery-item">
                            @if($label)
                                <x-main::input.label :value="__($label)"/>
                            @endif
                            <img width="400" class="w-full" src="{{$item}}" loading="lazy" alt="">
                            <input type="hidden" value="{{$item}}" name="gallery[]">
                            <button onclick="deleteGalleryItem(event)" type="button" class="text-red-700">delete
                            </button>
                        </div>

                    @endforeach
                @endif
            </div>
            <div class="my-3">
                <x-main::button.hollow-primary type="button" class="ml-3 w-full block button-image" id="button-gallery"
                                               data-for="gallery_type">
                    {{ __('add gallery image') }}
                </x-main::button.hollow-primary>
            </div>
            <x-main::input.error :messages="$errors->get('gallery')" class="mt-2"/>
            <x-main::input.error :messages="$errors->get('gallery.*')" class="mt-2"/>
        </section>
    @endif
</x-main::accordion.single>
