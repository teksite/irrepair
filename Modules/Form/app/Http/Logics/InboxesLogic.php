<?php

namespace Modules\Form\Http\Logics;

use Modules\Form\Events\NewFormSubmittedEvent;
use Modules\Form\Models\Form;
use Modules\Form\Models\FormInbox;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;
use Modules\Main\Traits\Upload\Uploader;


class InboxesLogic
{
     use HasTrash ,Uploader;
     const model = FormInbox::class;


    public function getAllInboxes()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(FormInbox::class ,['created_at'],relation:['form' ,'user'] );
        });
    }
    public function getAllInboxesByForm(Form $form)
    {
        return app(ServiceWrapper::class)(function () use($form) {
            return app(FetchServiceData::class)($form->inboxes() ,['created_at'] );
        });
    }

    public function registerNewFormRequest(array $inputs)
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            $form_id = ($inputs['form_id']);
            $ip = request()->ip();
            $url = $inputs['url'] ?? null;


            $form =Form::query()->find($form_id);
            if(isset($inputs['g-recaptcha-response']))  unset($inputs['g-recaptcha-response']);
            $data=Arr::except($inputs, ['form_id' ,'url' ,'formpot' ,'file']);
            if(isset($inputs['file'])){
                $path= $this->fileUploader($inputs['file'] , 'cv');
                $data['file']=config('app.url').$path;
            }
            $inbox = $form->inboxes()->create(['data' => $data, 'ip_address'=>$ip ,'url'=>$url]);
            event(new NewFormSubmittedEvent($form , $inbox));
            return $inbox;
        });
    }
    public function changeInbox(array $inputs, FormInbox $inbox): ServiceWrapper|ServiceResult
    {
        return app(ServiceWrapper::class)(fn()=>$inbox->update($inputs));
    }

    public function destroyInbox(FormInbox $inbox): ServiceWrapper|ServiceResult
    {
        return app(ServiceWrapper::class)(fn()=> $inbox->delete());
    }

}
