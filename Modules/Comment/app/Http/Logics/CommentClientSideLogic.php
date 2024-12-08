<?php

namespace Modules\Comment\Http\Logics;

use Modules\Comment\Events\NewCommentSubmittedEvent;
use Modules\Comment\Models\Comment;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;


class CommentClientSideLogic
{
    //use HasTrash;
    //const model = Module::class;


    public function getAllComments()
    {

        return app(ServiceWrapper::class)(function () {
            $comments = auth()->user()->comments();

            if ($status = request('status')) {
                if ($status == 'confirmed') {
                    $comments = $comments->whereConfirmed(true);
                } elseif ($status == 'unconfirmed') {
                    $comments = $comments->whereConfirmed(false);
                }
            }

            return $comments->latest()->paginate(20);
        });
    }

    public function submitNewComment(array $inputs)
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            $changedParams = [
                'message' => $inputs['message'],
                'parent_id' => $inputs['parent_id'] == 0 ? null : $inputs['parent_id'],
                'model_id' => $inputs['commentable_id'],
                'model_type' => decrypt($inputs['commentable_type']),
                'email' => auth()->check() ? auth()->user()->email : $inputs['email'],
                'name' => auth()->check() ? auth()->user()->name : $inputs['name'],
                'user_id' => auth()->check() ? auth()->id() : null,
                'ip_address' => request()->ip(),
            ];

            $comment = Comment::query()->create($changedParams);


              // event(new NewCommentSubmittedEvent($comment));

            return collect($changedParams['message']);
        });

    }


    public function changeComment(array $inputs, Comment $comment)
    {
        return app(ServiceWrapper::class)(fn() => $comment->update($inputs));
    }


    public function destroyComment(Comment $comment)
    {
        return app(ServiceWrapper::class)(fn() => $comment->delete());
    }

    public function loadMoreCommentByAjax(array $inputs)
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {

            $paginate = (integer)$inputs['page'];
            $model = decrypt($inputs['commentable_type']);
            $modelId = $inputs['commentable_id'];

//            $comments = Comment::query()
//                ->where('model_id', $modelId)
//                ->where('model_type', $model)
//                ->orWhere('parent_id', '0')
//                ->where('confirmed', true)
//                ->latest()
//                ->skip(5 + 5 * $paginate)
//                ->take(5)
//                ->get();
            $commentView = view('components.comment.comment-items', ['model' => (new $model)->find($modelId), 'offset' => (5 + 5 * $paginate)])->render();

            return $commentView;
        });

    }

}
