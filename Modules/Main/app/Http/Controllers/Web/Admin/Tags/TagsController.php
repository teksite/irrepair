<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Tags;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Http\Logics\TagsLogic;
use Modules\Main\Http\Requests\Admin\TagRequest;
use Modules\Main\Models\Tag;
use Modules\Main\Services\Facade\WebResponse;

class TagsController extends Controller implements HasMiddleware
{

    public function __construct(public TagsLogic $logic)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:tag-edit'),
        ];
    }

    public function index()
    {
        $res=$this->logic->getAllTags();
        $tags = $res->data;

        return view('main::pages.admin.tags.index' , compact('tags'));
    }

    public function create()
    {
        return action([$this,'index']);
    }

    public function store(TagRequest $request)
    {
        $result=$this->logic->registerTag($request->validated());
        return WebResponse::byResult($result, 'admin.tags.index')->go();

    }

    public function show(Tag $tag)
    {
        abort(404);
    }

    public function edit(Tag $tag)
    {
        return view('main::pages.admin.tags.edit' , compact('tag'));
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $result=$this->logic->changeTag($request->validated() ,$tag);
        return WebResponse::byResult($result, 'admin.tags.edit')->params($tag)->go();
    }

    public function destroy(Tag $tag)
    {
        $result = $this->logic->destroyTag($tag);
        return WebResponse::redirect()->byResult($result, 'admin.tags.index')->go();
    }
}
