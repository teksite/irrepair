<?php

namespace Modules\Comment\Http\Controllers\Web\Panel\Comments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Comment\Http\Logics\CommentClientSideLogic;
use Modules\Comment\Http\Requests\Panel\CommentRequest;
use Modules\Comment\Models\Comment;
use Modules\Main\Services\Facade\WebResponse;

class CommentsController extends Controller implements HasMiddleware
{
    protected int $delete_until;
    protected int $edit_until;

    public function __construct(public CommentClientSideLogic $logic)
    {
        $this->delete_until = config('sitesetting.comment_delete_until' ,60);
        $this->edit_until = config('sitesetting.comment_edit_until' ,60);
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:client-comment-read'),
            new Middleware('can:client-comment-create', only: ['create', 'store']),
            new Middleware('can:client-comment-edit', only: ['edit', 'update']),
            new Middleware('can:client-comment-delete', only: ['destroy']),
        ];
    }


    public function index()
    {
        $result = $this->logic->getAllComments();
        $comments = $result->data;
        return view('comment::pages.panel.comments.index', compact('comments'));
    }


    public function create()
    {
        abort(404);
    }


    public function store(Request $request)
    {
        abort(404);
    }


    public function show(Comment $comment)
    {
        abort(404);
    }


    public function edit(Comment $comment)
    {

        $this->checking($comment, $this->edit_until);
        return view('comment::pages.panel.comments.edit', compact('comment'));
    }


    public function update(CommentRequest $request, Comment $comment)
    {
        $this->checking($comment, $this->edit_until);
        $result = $this->logic->changeComment($request->validated(),$comment);
        return WebResponse::redirect()->byResult($result , 'panel.comments.index')->go();

    }


    public function destroy(Comment $comment)
    {
        $this->checking($comment, $this->delete_until);
        $result = $this->logic->destroyComment($comment);
        return WebResponse::redirect()->byResult($result,'panel.comments.index')->go();

    }


    private function checking(Comment $comment, $minutes)
    {
        if($comment->user_id !=auth()->user()->id) abort(404);
        if (now() > \Carbon\Carbon::parse($comment->created_at)->addMinutes($minutes) || $comment->confirmed) abort(403);
    }
}
