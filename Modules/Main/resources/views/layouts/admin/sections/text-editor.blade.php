@props(['name'=>'body' ,'column'=>'body', 'title'=>'body' ,'open'=>'true','accordion'=>true])

<div>
    <x-main::accordion.single :title="$title" :open="$open" :accordion="$accordion">
        <x-main::input.textarea aria-label="{{__($title)}}" id="body-{{$name}}" class="block w-full text-editor" name="{{$name}}" rows="16">{{old($name) ?? $instance->$column ?? ''}}</x-main::input.textarea>
    </x-main::accordion.single>
    <x-main::input.error :messages="$errors->get($name)" class="mt-2"/>
</div>


{{--<script src="https://cdn.tiny.cloud/1/ftzj6b6jbhal2t132rzhabepqa4f4x4b5h1vuchm7iouw861/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>--}}
{{--<script>--}}
{{--    tinymce.init({--}}
{{--        selector: 'textarea.text-editor', // Replace this CSS selector to match the placeholder element for TinyMCE--}}
{{--        plugins: 'code table lists',--}}
{{--        toolbar: 'undo redo | blocks | bold italic | forecolor backcolor |alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',--}}
{{--        menubar:''--}}
{{--    });--}}
{{--</script>--}}
