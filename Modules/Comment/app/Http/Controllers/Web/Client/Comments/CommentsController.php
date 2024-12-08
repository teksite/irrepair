<?php

namespace Modules\Comment\Http\Controllers\Web\Client\Comments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Comment\Http\Logics\CommentClientSideLogic;
use Modules\Comment\Http\Requests\Client\CommentRequest;
use Modules\Main\Services\Facade\WebResponse;

class CommentsController extends Controller
{
    public function __construct(public CommentClientSideLogic $logic)
    {
    }

    public function store(CommentRequest $request)
    {
        $result = $this->logic->submitNewComment($request->validated());
        return WebResponse::redirect()->byResult($result)->go();
    }

}
