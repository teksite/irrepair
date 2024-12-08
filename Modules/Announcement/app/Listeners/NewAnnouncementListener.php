<?php

namespace Modules\Announcement\Listeners;

use App\Models\User;
use Illuminate\Bus\Batch;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Modules\Announcement\Events\NewAnnouncementEvent;
use Modules\Announcement\Jobs\AnnouncementBySMSJob;
use Modules\Main\Jobs\NotificationUsersByEmailJob;
use Modules\Main\Models\Role;
use Modules\Newsletter\Models\NewsletterEmail;

class NewAnnouncementListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(NewAnnouncementEvent $event): void
    {
        $inputs = $event->inputs;

        $announcement = $event->announcement;

        $this->processRoutes($inputs, $announcement);
    }



    private function processRoutes(array $inputs, $announcement): void
    {
        if (isset($inputs['routes']) && (in_array('email' ,$inputs['routes']) || in_array('site' ,$inputs['routes']) || in_array('sms' ,$inputs['routes']) )) {

                $users = $this->fetchUsers($inputs);

                if (in_array('email', $inputs['routes'])) {
                    $this->byEmails($users['emails'], $announcement);
                }

                if (in_array('site', $inputs['routes'])) {
                    $this->bySite($users['ids'], $announcement);
                }
//                if (in_array('sms', $inputs['routes'])) {
//                    $this->bySms($users['phones'], $announcement);
//                }

        } elseif ($inputs['target'] === 'newsletter') {
            $this->byEmails($this->fetchEmailsfromNewsletter()['emails'], $announcement);
        }
    }

    private function byEmails($emails, $announcement): void
    {
        $jobBatch = array_map(
            fn($email) => new NotificationUsersByEmailJob($email, $announcement->title, $announcement->message), $emails);
        Bus::batch($jobBatch)
            ->onQueue('notification')
            ->name('announcement - ' . $announcement->title ?? '')
            ->catch(function (\Throwable $exception) {
                Log::error($exception->getMessage());
            })
            ->dispatch();
    }

    private function bySite(array $ids, $announcement): void
    {
        $announcement->users()->attach($ids);
    }
    private function bySMS(array $phones, $announcement): void
    {
        $jobBatch = array_map(
            fn($phone) => new AnnouncementBySMSJob($phones, $announcement->message ,'patten'), $phones
        );

        Bus::batch($jobBatch)
            ->onQueue('notification')
            ->name('announcement')
            ->catch(function (\Throwable $exception) {
                Log::error($exception->getMessage());
            })
            ->dispatch();
    }

    private function fetchUsers(array $data)
    {
        $userQuery = User::query()->select('id', 'email');

        $firstQuery = true;

        if (isset($data['roles']) && count($data['roles'])) {
            $userQuery->whereHas('roles', function ($query) use ($data) {
                $query->whereIn('id', $data['roles']);
            });
            $firstQuery = false;
        }
        if (isset($data['users']) && count($data['users'])) {
            if (!$firstQuery) {
                $userQuery->orWhereIn('id', $data['users']);
            }else{
                $userQuery->whereIn('id', $data['users']);
            }
        }

        $users = $userQuery->get();

        return [
            'emails' => $users->pluck('email')->unique()->toArray(),
            'ids' => $users->pluck('id')->unique()->toArray(),
            'phones' => $users->pluck('phones')->unique()->toArray(),
            'telegrams' => $users->pluck('telegram_id')->unique()->toArray(),
        ];

    }

    private function fetchEmailsfromNewsletter()
    {
        $mails = NewsletterEmail::query()->where('stance','on')->select('email')->get();

        return [
            'emails' => $mails->pluck('email')->unique()->toArray(),
        ];

    }
}
