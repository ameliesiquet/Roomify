<?php

namespace App\Mail;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Config;

class CustomVerifyEmail extends VerifyEmail
{
    protected function buildMailMessage($url): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Email Verification Link')
            ->markdown('emails.verify-email', [
                'url' => $url,
                'count' => Config::get('auth.verification.expire', 60),
            ]);
    }
}
