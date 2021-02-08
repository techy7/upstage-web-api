<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\ChatMessage;
use App\User;

class MessageUser extends Notification
{
    use Queueable;
    protected $message; 

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;  
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'chat_hash'=>$this->message['chat_hash'], 
            'body'=>$this->message['body'],
            'message_hash'=>$this->message['message_hash'],
            'project_hash'=>$this->message['project_hash'],
            'project_name'=>$this->message['project_name'],
            'presentation_hash'=>$this->message['presentation_hash'], 
            'presentation_name'=>$this->message['presentation_name'], 
            "module"=>'new_chat_message'
        ];
    }
}
