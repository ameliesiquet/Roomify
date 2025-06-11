<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Config;

class CustomVerifyEmail extends BaseVerifyEmail
{
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('Verify Your Email Address')
            ->markdown('emails.verify-email', [
                'url' => $url,
                'count' => Config::get('auth.verification.expire', 60),
            ]);
    }
}
