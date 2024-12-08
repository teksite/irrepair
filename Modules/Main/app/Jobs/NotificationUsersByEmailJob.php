<?php

namespace Modules\Main\Jobs;

use App\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Modules\Main\Notifications\EmailNotification;

class NotificationUsersByEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels ,Batchable;
    public function middleware(): array
    {
        return [new SkipIfBatchCancelled];
    }
    public int $maxExceptions = 5;
    public int $tries = 5;

    public function __construct(public User|Authenticatable|string $to, public string $subject, public array|string $messages, public array|null $url = null, public array|string|null $afterMessage = null, public ?string $greeting = null, public string|array|null $bcc = null)
    {
        $this->onQueue('notification');
    }

    public function backoff(): array
    {
        $backoff = [60];
        $tries = $this->tries;
        for ($i = 1; $i <= $tries; $i++) {
            $backoff[] = $i * 60;
        }
        return $backoff;
    }

    public function handle(): void
    {
        sleep(5);

        if (is_string($this->to))
            Notification::route('mail', $this->to)->notify(new EmailNotification($this->subject, $this->messages, $this->url, $this->afterMessage ,$this->greeting ,$this->bcc ));

        if($this->to instanceof Authenticatable)
            $this->to->notify(new EmailNotification($this->subject, $this->messages, $this->url, $this->afterMessage ,$this->greeting ,$this->bcc ));
    }


    public function failed(\Throwable $exception)
    {
        Log::driver('info')->info($exception->getMessage());
    }


}
