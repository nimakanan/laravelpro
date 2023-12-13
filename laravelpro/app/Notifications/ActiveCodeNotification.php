<?php

namespace App\Notifications;

use App\Notifications\Channels\GhasedacChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActiveCodeNotification extends Notification
{
    use Queueable;
public $code;
public $phone;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($code,$phone)
    {
        $this->code=$code;
        $this->phone=$phone;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [GhasedacChannel::class];
    }
    public function toGhasedakSms($notifiable){
        return[
           'text'=>"کد ورود به وب سایت\n وبسایت راکت {$this->code}",
            'number'=>$this->phone
        ];
    }
}
