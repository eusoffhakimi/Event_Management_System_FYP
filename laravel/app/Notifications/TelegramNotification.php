<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Telegram\Bot\Api;

class TelegramNotification extends Notification
{
    use Queueable;

    protected $event; // Property to hold the event data

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['telegram']; // Specify the 'telegram' channel
        return[];
    }

    public function toTelegram($notifiable)
    {
        // $telegram = new Api(config('services.telegram.bot_token')); // Use configuration
        // $telegram = new Api(config('.env.TELEGRAM_BOT_TOKEN'));
        $telegramUrl = "https://api.telegram.org/bot7057373692:AAHxvJWfpVjCq8KklhIOKrSznWQjh7om2Po/sendMessage";
        // $chatId = "-1002008631840";
        $chatId = "-2008631840";

        $message = "New Event Created! \n";
        $message = "**Club**" . $this->event->club->user->name . "\n";
        $message = "**Title**" . $this->event->event_title . "\n";

        $curl = curl_init($telegramUrl);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'markdown',
            ]),
        ]);

        curl_exec($curl);
        curl_close($curl);
        // $telegram->sendMessage(config('services.telegram.channel_id'), $message);
        // $telegram->sendMessage(config('.env.TELEGRAM_CHANNEL_ID'), $message);
    }

    // /**
    //  * Get the mail representation of the notification.
    //  *
    //  * @param  mixed  $notifiable
    //  * @return \Illuminate\Notifications\Messages\MailMessage
    //  */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
