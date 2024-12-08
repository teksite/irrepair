<?php

namespace Modules\Main\Http\Logics;

use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Models\SeoModel;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;



class SeoTypesLogic
{

    public function getView(array $inputs)
    {

        return app(ServiceWrapper::class)(function() use ($inputs) {
            $type=$inputs['seoType'];

            $seoData = isset($inputs['instance'], $inputs['id'])
                ? SeoModel::where('model_type',$inputs['instance'])->where('model_id', $inputs['id'])->first()
                :  null;
            $schema = $seoData && $seoData?->schema ? $seoData->schema : [];


            $view = match ($type) {
                'Article' => view('main::layouts.admin.sections.seo.types.article' ,['schema'=>$schema]),
                'Blog' => view('main::layouts.admin.sections.seo.types.blog' ,['schema'=>$schema]),
                'Event' => view('main::layouts.admin.sections.seo.types.event' ,['schema'=>$schema]),
                'FAQPage' => view('main::layouts.admin.sections.seo.types.faq' ,['schema'=>$schema]),
                'HowTo' => view('main::layouts.admin.sections.seo.types.howto' ,['schema'=>$schema]),
                'JobPosition' => view('main::layouts.admin.sections.seo.types.JobPosition' ,['schema'=>$schema]),
                'Person' => view('main::layouts.admin.sections.seo.types.person' ,['schema'=>$schema]),
                'SoftwareApplication' => view('main::layouts.admin.sections.seo.types.software' ,['schema'=>$schema]),
                'VideoObject' => view('main::layouts.admin.sections.seo.types.video' ,['schema'=>$schema]),
                'Product' => view('main::layouts.admin.sections.seo.types.product' ,['schema'=>$schema]),
                'ContactPage' => view('main::layouts.admin.sections.seo.types.contact' ,['schema'=>$schema]),
                /*
                 'Recipe' => view('main::layouts.admin.sections.seo.types.recipe' ,['schema'=>$schema]),
                */
                default => view('main::layouts.admin.sections.seo.types.webpage' ,['schema'=>$schema]),
            };
            return $view->render();
        });

    }

}
