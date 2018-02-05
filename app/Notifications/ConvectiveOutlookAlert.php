<?php

namespace App\Notifications;

use App\ConvectiveOutlook;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;

class ConvectiveOutlookAlert extends Notification
{
    use Queueable;

    protected $convectiveOutlook;
    protected $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(convectiveOutlook $convectiveOutlook, User $user )
    {
        $this->user = $user;
        $this->convectiveOutlook = $convectiveOutlook;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if(NULL == $this->user->notificationPreference->method){
            return [];
        }
        switch ($this->user->notificationPreference->method) {
            case 'all':
                return ['mail',TwilioChannel::class];
                break;
            case 'sms':
                return [TwilioChannel::class];
                break;
            case 'email':
                return ['mail'];
                break;
        }
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
                    ->line("WeatherCheck: ")
                    ->action($this->convectiveOutlook->risk_name , url('/'))
                    ->line('could be headed your way. We will continue monitoring, and send your Report, if damage is indicated. Stay safe!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            //
        ];
    }

    public function toTwilio( $notifiable ) {
        return (new TwilioSmsMessage("WeatherCheck: ".$this->convectiveOutlook->risk_name." could be headed your way. We will continue monitoring, and send your Report, if damage is indicated. Stay safe!"));
    }
}
