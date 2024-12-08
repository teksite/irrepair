<?php

namespace Modules\Main\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailNotification extends Notification
{
    use Queueable;


    public function __construct(public string $subject, public array|string $messages, public array|null $url = null, public array|string|null $afterMessage = null, public ?string $greeting =null , public string|array|null $bcc = null)
    {
        $this->onQueue('notification');
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $mail = new MailMessage;
        $mail = $mail->markdown('main::emails.notification')
            ->subject($this->subject . ' - ' . __(config('app.name')));

        if ($this->bcc) $mail->bcc($this->bcc);

        if ($this->greeting) $mail->greeting($this->greeting);

        if (is_array($this->messages)) {
            $mail->lines($this->messages);
        } else {
            $mail->line($this->messages);
        }

        $mail->action($this->url['title'] ??  __(config('app.name')) , $this->url['url'] ?? config('app.url'));

        if ($this->afterMessage) {
            if (is_array($this->afterMessage)) {
                $mail->lines($this->afterMessage);
            } else {
                $mail->line($this->afterMessage);
            }
        }
        return $mail;
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [];
    }
}
