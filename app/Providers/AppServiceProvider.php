<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            $id = $notifiable->getKey();
            $hash = sha1($notifiable->getEmailForVerification());
            $expoUrl = "exp://192.168.1.100:8081/--/verify-email?id={$id}&hash={$hash}";
            return (new MailMessage)
                ->subject('Verifikasi Email Kamu')
                ->view('mail.verify_email', ['url' => $expoUrl]);
        });
    }
}
