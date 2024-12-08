<?php

namespace Modules\Comment\Http\Controllers\Web\Admin\Comments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Comment\Http\Logics\CommentsLogic;
use Modules\Comment\Http\Requests\Admin\CommentRequest;
use Modules\Comment\Http\Requests\Admin\CommentSelectiveDeleteRequest;
use Modules\Comment\Models\Comment;
use Modules\Main\Services\Facade\WebResponse;

class CommentsController extends Controller implements HasMiddleware
{
    public function __construct(public CommentsLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:comment-read'),
            new Middleware('can:comment-create', only: ['create', 'store']),
            new Middleware('can:comment-edit', only: ['edit', 'update']),
            new Middleware('can:comment-delete', only: ['destroy']),
        ];
    }


    public function index()
    {
        $result = $this->logic->getAllComments();
        $comments = $result->data;
        $trash = $this->logic->trashesCount();
        $trashCount = $trash->data;
        return view('comment::pages.admin.comments.index', compact('comments', 'trashCount'));
    }


    public function create(Comment $comment)
    {
        return redirect()->action($this->show($comment));
    }


    public function store(CommentRequest $request)
    {
        $result = $this->logic->replyToComment($request->validated());
        $comment = $result->data;
        return WebResponse::redirect()->byResult($result, 'admin.comments.edit')->params($comment)->go();
    }


    public function show(Comment $comment)
    {
        return view('comment::pages.admin.comments.create', compact('comment'));
    }


    public function edit(Comment $comment)
    {
        $bloodline = $comment->bloodline()->orderBy('parent_id')->get();
        return view('comment::pages.admin.comments.edit', compact('comment', 'bloodline'));
    }


    public function update(CommentRequest $request, Comment $comment)
    {
        $result = $this->logic->changeComment($request->validated(), $comment);
        return WebResponse::redirect()->byResult($result, 'admin.comments.edit')->params($comment)->go();
    }


    public function destroy(Comment $comment)
    {
        $result = $this->logic->destroyComment($comment);
        return WebResponse::redirect()->byResult($result, 'admin.comments.index')->go();
    }


    public function delete(CommentSelectiveDeleteRequest $request)
    {
        $result = $this->logic->deleteSelectedComment($request->validated());
        return WebResponse::redirect()->byResult($result, 'admin.comments.index')->go();
    }
}
