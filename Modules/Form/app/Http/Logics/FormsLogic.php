<?php

namespace Modules\Form\Http\Logics;

use Modules\Form\Models\Form;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;



class FormsLogic
{
     //use HasTrash;
     const model = Form::class;

    public function getAllForms()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(Form::class ,['title'] );
        });
    }

    public function registerForm(array $inputs): ServiceWrapper|ServiceResult
    {

        return app(ServiceWrapper::class)(function() use($inputs){
            $inputs['emails']=exploding($inputs['emails']);
            $inputs['phones']=exploding($inputs['phones']);
            $inputs['urls']=exploding($inputs['urls']);
            $inputs['telegram_id']=exploding($inputs['telegram_id']);
            return Form::query()->create($inputs);
        });
    }

    public function changeForm(array $inputs, Form $form): ServiceWrapper|ServiceResult
    {
        return app(ServiceWrapper::class)(
            function() use($inputs ,$form){
                $inputs['recaptcha']=isset($inputs['recaptcha']);
                $inputs['emails']=exploding($inputs['emails']);
                $inputs['phones']=exploding($inputs['phones']);
                $inputs['urls']=exploding($inputs['urls']);
                $inputs['telegram_id']=exploding($inputs['telegram_id']);
                return $form->update($inputs);
            });
    }

    public function destroyForm(Form $form): ServiceWrapper|ServiceResult
    {
        return app(ServiceWrapper::class)(fn()=> $form->delete());
    }

}
