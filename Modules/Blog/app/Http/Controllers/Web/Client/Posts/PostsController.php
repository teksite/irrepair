<?php

namespace Modules\Blog\Http\Controllers\Web\Client\Posts;

use App\Http\Controllers\Controller;
use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Post;
use Modules\Main\Http\Logics\SeoGeneralLogic;
use Modules\Main\Traits\Seo\SeoGenerator;

class PostsController extends Controller
{
    use SeoGenerator;


    public function index()
    {
        $seo=(new SeoGeneralLogic())->getOtherSeo('blog_index')->data;
        $seo =$this->generateSeo([
            'seo_type'=>$seo['seo_type'] ?? 'CollectionPage',
            'title'=>$seo['seo_type'] ?? 'برسانش' . ' - ' .__(config('app.name')),
            'description'=>$seo['description'] ?? 'برسا نوین رای با ارائه مقالات مختف در زمینه های مختلف برنامه نویسی و نرم افزارهای اداری سعی در افزایش و بهبود سطح علمی دارد',
            'breadcrumb'=>[
                config('blog.blog_title')=>url()->current()
            ],
            'listItems'=>Post::query()->latest()->take(5)->get(['id','title','slug'])->toArray(),
        ]);

        $posts = Post::query()->with(['categories']);
        if ($keyword = request()->categories) {
            $posts = $posts->whereHas('categories', function (Builder $query) use ($keyword) {
                $query->where('title', $keyword);
            });
        }
        $posts = $posts->latest()->paginate(20);

        $categories = Category::all();
        $pinnedPosts = Post::query()->whereNotNull('pinned')->orderBy('pinned')->limit(5)->get();

        return view("pages.blog.index" ,compact('posts' ,'categories'  ,'pinnedPosts' ,'seo'));
    }


    public function show(Post $post)
    {
        $svg = (new Writer(
            new ImageRenderer(
                new RendererStyle(100, 0, null, null, Fill::uniformColor(new Rgb(255, 255, 255), new Rgb(45, 55, 72))),
                new SvgImageBackEnd
            )
        ))->writeString($post->path());

        $seo = $post->generateSeo();
        return View::first(["pages.blog.templates.$post->template",'pages.blog.show'],compact('post' ,'seo' ,'svg'));
    }
}
