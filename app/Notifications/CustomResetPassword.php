<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Config;
use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;

class CustomResetPassword extends BaseResetPassword
{
    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset your password')
            ->markdown('emails.reset-password', [
                'url' => $url,
                'count' => Config::get('auth.passwords.'.Config::get('auth.defaults.passwords').'.expire', 60),
            ]);
    }
}
