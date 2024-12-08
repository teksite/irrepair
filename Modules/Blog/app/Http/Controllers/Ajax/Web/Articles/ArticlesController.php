<?php

namespace Modules\Blog\Http\Controllers\Ajax\Web\Articles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Blog\Http\Logics\ArticlesLogic;
use Modules\Blog\Models\Article;
use Modules\Main\Services\Facade\ApiResponse;

class ArticlesController extends Controller
{
    public function __construct(public ArticlesLogic $logic)
    {
    }

    public function index(Request $request)
    {
        $validated=Validator::make($request->all() ,['title'=>'required|string'])->validate();
        $result = $this->logic->fetchData(Article::class , $validated);
        return ApiResponse::response()->byResult($result)->reply();
    }
}
