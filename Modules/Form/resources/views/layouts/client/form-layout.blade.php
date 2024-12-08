@props(['class'=>null, 'classForm'=>null ,'classBtn'=>null ,'classBtnBox'=>null,'btnTx'=>'submit' ,'id'])
@php
    $form = \Modules\Form\Models\Form::find($id);
    $uuid =uuid_create().rand(10,100);
    $ajaxMode=config('sitesetting.form_ajax' ,true) ?? true;

@endphp
@if($form)
    <div class="form-box {{$class}}">
        <form  id="{{$uuid}}" action="{{route('forms.submit')}}" class="form {{$classForm}} {{$ajaxMode ? 'collect-data-form' :''}}" method="POST" {{$form->has_file ?"enctype=multipart/form-data" :''}}>
            @csrf
            <input type="hidden" readonly value="{{$id}}" name="form_id">
            <input type="hidden" class="input hidden" name="formpot">
            <input type="hidden" class="hidden" name="url" value="{{url()->current()}}" readonly>
            @if($form->template)
               @include("forms.$form->template")
            @else
                <div>
                    {!! $form->body !!}
                </div>
            @endif
            @if($form->recaptcha)
            <div>
                <div class="mb-3 flex items-center gap-1">
                    <x-main::input.label class="min-w-fit !mb-0" :value="__('captcha code')" for="captcha-code"/>
                    <x-captcha::load/>
                </div>
            </div>
            @endif
            @if ($errors->any())
                <hr class="my-3">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-700 font-bold text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
                <hr class="my-3">
            @endif
            <div class="{{$classBtnBox ?? 'flex justify-end min-w-fit w-fit'}}">
                <button class="primary-solid {{$classBtn}}" type="submit" role="button">
                    {{__($btnTx)}}
                </button>
            </div>
        </form>
    </div>
@endif
