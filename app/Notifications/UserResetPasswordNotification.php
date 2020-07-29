<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class AdminResetPasswordNotification extends Notification
{
    use Queueable;
    
    //Token handler
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('パスワード変更のご依頼')
            ->line("この度は、パスワード変更のご依頼いただき誠にありがとうございます。下記のボタンを押してください。")
            // Use url instead of route here, if using route need to define in web.php
            ->action('パスワード変更', url('admin/password/reset', $this->token));
    }
}
