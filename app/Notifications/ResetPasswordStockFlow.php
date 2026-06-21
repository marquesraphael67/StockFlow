<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordStockFlow extends ResetPassword
{
    use Queueable;

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Redefinir senha - StockFlow')
            ->view('emails.reset-password-stockflow', [
                'url' => $url,
                'user' => $notifiable,
            ]);
    }
}