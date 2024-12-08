<?php

namespace Modules\Comment\Http\Controllers\Ajax\Client\Comments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Comment\Http\Logics\CommentClientSideLogic;
use Modules\Comment\Http\Requests\Client\CommentApiRequest;
use Modules\Comment\Http\Requests\Client\LoadMoreCommentApiRequest;
use Modules\Main\Services\Facade\ApiResponse;

class CommentsController extends Controller
{
    public function __construct(public CommentClientSideLogic $logic)
    {
    }

    public function store(CommentApiRequest $request)
    {
        $result = $this->logic->submitNewComment($request->validated());
        return apiResponse::response()->byResult($result)->reply();

    }

    public function more(LoadMoreCommentApiRequest $request)
    {
        $inputs = $request->validated();
        $result = $this->logic->loadMoreCommentByAjax($inputs);
        return apiResponse::response()->byResult($result)->reply();
    }
}
