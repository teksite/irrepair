<?php

namespace Modules\Comment\Http\Logics;

use Modules\Comment\Models\Comment;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;


class CommentsLogic
{
    use HasTrash;

    const model = Comment::class;

    public function getAllComments()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(Comment::class, ['confirmed', 'created_at', 'name', 'email']);
        });
    }

    public function changeComment(array $inputs, Comment $comment)
    {
        return app(ServiceWrapper::class)(fn() => $comment->update($inputs));
    }

    public function replyToComment(array $inputs)
    {

        return app(ServiceWrapper::class)(function () use ($inputs) {
            $inputs = array_merge($inputs, [
                'user_id' => auth()->id(),
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'ip_address' => request()->ip(),
            ]);
            return Comment::query()->create($inputs);
        });
    }


    public function destroyComment(Comment $comment)
    {
        return app(ServiceWrapper::class)(function () use ($comment) {
            $comment->descendantsAndSelf()->get()->each(function ($item) {
                $item->delete();
            });
        });
    }

    public function deleteSelectedComment(array $inputs)
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            if ($inputs['comments'] === 'unconfirmed') {
                Comment::query()->where('confirmed',0)->delete();
            } elseif ($inputs['comments'] === 'all') {
                Comment::query()->delete();
            } elseif ($inputs['comments'] === 'selected') {
                $ids=explode($inputs['comments'], ',');
                Comment::whereIn('id', $ids)->get()->each(function ($comment) {
                    $comment->descendantsAndSelf()->get()->each(function ($item) {
                        $item->delete();
                    });
                });
            }


        });
    }
}
