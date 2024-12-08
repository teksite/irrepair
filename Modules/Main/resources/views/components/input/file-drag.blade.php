@props(['disabled' => false])
@php
    $errorClass=isset($errors) && !is_null($attributes->get('name')) && $errors->has($attributes->get('name')) ?'!border-red-700':'';
    $random=rand(1234,987).'fileInput';
@endphp
<div class="drag-drop-zone">
    <div class="border border-dotted border-slate-200 rounded-lg p-3 ">

        <input type="file" {{$attributes->except('id')->merge(['class'=>'hidden fileInput'])}} id="{{$random}}" >
        <label for="{{$random}}" class="cursor-pointer flex flex-col items-center space-y-2 dropzone" >
            <svg class="w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <span class="text-gray-600">
            {{__('drag and drop your files here')}}
        </span>
            <span class="text-gray-2000 text-sm">
            (or click to select)
        </span>
        </label>
    </div>
    <div class="mt-6 text-xs fileList"></div>
</div>
