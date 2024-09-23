<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgetPasswordOtpNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user, $otp_code;
    /**
     * Create a new notification instance.
     */
    public function __construct($user, $otp_code)
    {
        $this->user = $user;
        $this->otp_code = $otp_code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Kode Verifikasi Jeladi')
            ->view(
            'email.request-otp-notification', ['user' => $this->user, 'otp_code' => $this->otp_code]
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
