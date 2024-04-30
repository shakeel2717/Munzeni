<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOTPVerificationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $user)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $channels = [];
        if (settings('email_otp_verification')) {
            $channels[] = 'mail';
        }
        if (settings('sms_otp_verification')) {
            $this->sendSms($notifiable);
        }
        return $channels;
    }

    private function sendSms(object $notifiable): void
    {
        info("Sending SMS " . $this->user->phone);

        $url = 'http://bulksmsbd.net/api/smsapi';
        $apiKey = env('BULK_SMS_API_KEY');
        $number = $notifiable->phone;
        $senderId = env('BULK_SMS_SENDER_ID');
        $message = "Your OTP for account verification is: " . $this->user->otp;

        $params = [
            'api_key' => $apiKey,
            'type' => 'text',
            'number' => $number,
            'senderid' => $senderId,
            'message' => $message,
        ];

        if (env('APP_ENV') == 'production') {
            // Use curl to send the SMS
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            info("Response: " . json_encode($response));
        }
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line("Please verify your Account using this OTP")
            ->line("OTP: " . $this->user->otp)
            ->line('Thank you for using our application!');
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
