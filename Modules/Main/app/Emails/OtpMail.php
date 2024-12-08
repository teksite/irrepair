<?php

namespace Modules\Main\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\View;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public string $code)
    {
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->view('main::emails.otp-mail' ,['user'=>$this->to[0]]);
    }

}
