<?php

namespace Modules\Comment\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Comment\Events\NewCommentSubmittedEvent;
use Modules\Comment\Models\Comment;
use Modules\Main\Jobs\NotificationAdminByEmailJob;

class NewCommentSubmittedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param NewCommentSubmittedEvent $event
     */
    public function handle(NewCommentSubmittedEvent $event): void
    {
        $comment = $event->comment;

        $this->sendByEmail($comment);
    }
    public function sendByEmail(Comment $comment)
    {
        $parent=$comment->model()->select(['title','id','slug'])->first();
        $subject = __('a new comment is submitted');
        $message = [
            __('a new comment is submitted, the related page is ":title"', ['title' => $parent->title]),
            __('message') .':',
            $comment->message,
        ];
        $action = [__('check it'), route('admin.comments.show' , $comment)];


        $i=1;
        foreach (config('sitesetting.comment_email_notification') as $email) {
            NotificationAdminByEmailJob::dispatch($email, $subject, $message, $action)->delay(now()->addSeconds($i * 5));
            $i++;
        }

    }

}
