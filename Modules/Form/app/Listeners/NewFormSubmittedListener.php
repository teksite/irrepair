<?php

namespace Modules\Form\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Form\Events\NewFormSubmittedEvent;
use Modules\Main\Jobs\NotificationAdminByEmailJob;

class NewFormSubmittedListener
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
     */
    public function handle(NewFormSubmittedEvent $event): void
    {
        $form = $event->form;
        $receive = $event->inbox;
        $toEmails = $form->emails;
        $toUrls = $form->urls;

        $this->sendByEmail($toEmails ,$receive , $form) ;

    }

    public function sendByEmail($emails ,$receive , $form)
    {
        $subject = __('a new form is submitted');
        $message = [
            __("a new form is submitted, the form is :title", ['title' => $form->title]),
            __('url') . ': ' . $receive->url,
        ];
        $action = [__('check it'), route('admin.forms.inboxes.edit', [$form, $receive])];

        $tableData = $this->generateTableDataForEmail($receive->data->toArray());

        $i=1;
        foreach ($emails as $email) {
            NotificationAdminByEmailJob::dispatch($email, $subject, $message, $action, $tableData)->delay(now()->addSeconds($i * 5));
            $i++;
        }

    }


    public function generateTableDataForEmail(array $details): string
    {
        $tableData = "<div dir='rtl' style='display: block;width: 100%'></div><table style='width:100%;border:1px solid #ccc'><tbody>";

        $iterationCount = 0;

        foreach ($details as $key => $value) {
            if ($key == 'formpot') continue;
            $trStyle = $iterationCount % 2 == 0 ? 'background:#ebeaea' : 'background:#fff';

            $data = is_array($value) ? implode(' , ', $value) : e($value);
            $th = __(e($key));
            $tableData .= "<tr style='$trStyle'><th>$th</th><td>$data</td></tr>";
        }

        $tableData .= "</tbody></table>";

        return $tableData;
    }
}
