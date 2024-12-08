<?php

namespace Modules\Form\Http\Requests\Client;

use Modules\Captcha\Rules\CaptchaRule;
use Modules\Form\Models\Form;
use Modules\Main\Action\ApiRequest;

class ReceiveApiRequest extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return  $this->defaultRules();
    }


    public function defaultRules():array
    {
        $form =Form::find($this->request->get('form_id'));
        $extraRules=[];

        if($form){
            $formRules=$form->rules?->toArray() ?? [];
            foreach ($formRules as $formRule){
                $extraRules[$formRule['name']]=$formRule['rule'];
            }
        }

        $globalRules=[
            'form_id'=>'required|integer|exists:forms,id',
            'url' => 'required|string',
            "formpot"=>'prohibited',
            'g-recaptcha-response'=>['required' , new CaptchaRule],
        ];
        return  array_merge($globalRules,$extraRules);
    }
}
