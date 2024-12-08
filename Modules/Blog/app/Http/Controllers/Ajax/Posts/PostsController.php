<?php

namespace Modules\Blog\Http\Controllers\Ajax\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Blog\Http\Logics\PostsLogic;
use Modules\Blog\Models\Post;
use Modules\Main\Services\Facade\ApiResponse;

class PostsController extends Controller
{
    public function __construct(public PostsLogic $logic)
    {
    }

    public function index(Request $request)
    {
        $validated=Validator::make($request->all() ,['title'=>'required|string'])->validate();
        $result = $this->logic->fetchData(Post::class , $validated);
        return ApiResponse::response()->byResult($result)->reply();
    }
}
