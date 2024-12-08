@props(['title'=>'video','name'=>'video','column'=>'video','open'=>true ,'preview'=>true])
@php($random=rand(10 ,1000))
<x-main::accordion.single :title="$title" :open="$open">
    @if($preview)
        <video src="{{$instance->$column ?? ''}}" class="video-preview mb-3 w-full max-w-96" controls preload="auto" id="video-{{$random}}"></video>
    @endif
    <x-main::input.text id="{{$name}}" class="video-input block w-full"  name="{{$name}}" :value="old($name) ?? $instance->$column  ?? ''" data-for="video-{{$random}}"/>
    <x-main::input.error :messages="$errors->get($name)" class="mt-2"/>
</x-main::accordion.single>

@push('footerScripts')
    <script>
        const videoInputs =document.querySelectorAll('.video-input');
        const videoPreviews =document.querySelectorAll('.video-preview');
        if(videoInputs.length && videoPreviews.length){
            videoInputs.forEach(inputVideo=>{
                inputVideo.addEventListener('change',()=>{
                    const idPrev=inputVideo.getAttribute('data-for');
                    const prevEl=document.querySelector(`#${idPrev}`)
                    if(prevEl){
                        prevEl.src=inputVideo.value
                    }
                })
            })
        }
    </script>
@endpush
