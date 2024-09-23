<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuratSoftcopyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user, $surat;
    /**
     * Create a new notification instance.
     */
    public function __construct($user, $surat)
    {
        $this->user = $user;
        $this->surat = $surat;
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
            ->subject('Permohonan Surat Jeladi')
            ->view('email.surat-softcopy-notification', ['user' => $this->user, 'surat' => $this->surat])
            ->attach(url('storage/permohonan-surat/'.$this->surat->file_surat));
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
