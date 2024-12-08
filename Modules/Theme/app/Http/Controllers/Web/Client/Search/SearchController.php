<?php

namespace Modules\Theme\Http\Controllers\Web\Client\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Main\Traits\Seo\SeoGenerator;
use Modules\Theme\Http\Logics\SearchLogic;

class SearchController extends Controller
{
    use SeoGenerator;

    public function __construct(public SearchLogic $logic)
    {
    }

    public function index()
    {
        $seo =$this->generateSeo([
            'seo_type'=>'WebPage',
            'title'=>__(config('app.name')) .' - ' . __('search'),
            'description'=>'برسا نوین رای با ارائه مقالات مختف در زمینه های مختلف برنامه نویسی و نرم افزارهای اداری سعی در افزایش و بهبود سطح علمی دارد',
        ]);
        $result= $this->logic->searchModels();
        $data=($result->data);
        return view('pages.search' , compact('data','seo'));
    }
}

