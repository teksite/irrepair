<?php

namespace Modules\Theme\Http\Controllers\Web\Client\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Process;
use Modules\Main\Traits\Seo\SeoGenerator;
use Modules\Theme\Models\ThemeSetting;

class HomeController extends Controller
{
    use SeoGenerator;
    public function show()
    {

        $seo =$this->generateSeo([
            'seo_type'=>'WebPage',
            'title'=>__(config('app.name')) .' - ' . __('homepage'),
            'description'=>'برسا نوین رای با ارائه مقالات مختف در زمینه های مختلف برنامه نویسی و نرم افزارهای اداری سعی در افزایش و بهبود سطح علمی دارد',
        ]);

        if (!cache()->has('homepage_settings')){
            cache()->forever('homepage_settings' , ThemeSetting::query()->where('key','LIKE','home_%')->get()->keyBy('key')->toArray());
        }
//        $items=cache()->get('homepage_settings');

        $data=ThemeSetting::query()->where('key','LIKE',"homepage_%")->get()->pluck('value','key')->toArray();
        return view('pages.home' ,compact('data','seo'));    }
}
