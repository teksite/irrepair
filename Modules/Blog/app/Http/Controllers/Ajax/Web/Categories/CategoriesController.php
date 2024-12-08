<?php

namespace Modules\Blog\Http\Controllers\Ajax\Web\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Blog\Http\Logics\CategoriesLogic;
use Modules\Blog\Models\Category;
use Modules\Main\Services\Facade\ApiResponse;

class CategoriesController extends Controller
{
    public function __construct(public CategoriesLogic $logic)
    {
    }

    public function index(Request $request)
    {
        $validated=Validator::make($request->all() ,['title'=>'required|string'])->validate();
        $result = $this->logic->fetchData(Category::class , $validated);
        return ApiResponse::response()->byResult($result)->reply();
    }
}
