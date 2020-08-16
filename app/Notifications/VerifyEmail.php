<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;

class VerifyEmail extends Notification
{
    use Queueable;
    protected $user;
    protected $app;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user; 
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
        $signedURL = env('APP_URL').'/email-verify/'.$this->user->hash;

        return (new MailMessage)
                    ->subject('Welcome to '.env('APP_NAME'))
                    ->line('Please click the button below to verify your email address.')
                    ->action('Verify Email Address', $signedURL)
                    ->line('If you did not create an account, no further action is required.');
    }
}
