@props(['name'=>'body', 'title'=>'body', 'limit'=>true])

    <x-main::input.textarea id="body-{{$name}}" class="block w-full text-editor" name="{{$name}}" rows="16">{{$slot ?? ''}}</x-main::input.textarea>
    <x-main::input.error :messages="$errors->get($name)" class="mt-2"/>

@php
//
//$toolbar=$limit
//? 'code |undo redo | blocks | bold italic | bullist numlist |  table'
//: 'code |undo redo | blocks | bold italic | bullist numlist |  table | forecolor backcolor |alignleft aligncenter alignright | indent outdent '
 @endphp
<script src="https://cdn.tiny.cloud/1/ftzj6b6jbhal2t132rzhabepqa4f4x4b5h1vuchm7iouw861/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>

/*    tinymce.init({
        selector: 'textarea.text-editor', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists',
{{--        toolbar: '{{$toolbar}}',--}}
        menubar:''
    });*/
</script>
--}}
