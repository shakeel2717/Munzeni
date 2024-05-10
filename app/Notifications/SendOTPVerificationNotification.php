<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

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

        // Twilio credentials
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_PHONE_NUMBER');

        $message = "Your OTP for account verification is: " . $this->user->otp;

        $client = new Client($accountSid, $authToken);

        // Use the Client to make requests to the Twilio REST API
        $client->messages->create(
            // The number you'd like to send the message to
            '+8801752011680',
            [
                'from' => $twilioNumber,
                'body' => $message
            ]
        );

        info(json_encode($client));
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
