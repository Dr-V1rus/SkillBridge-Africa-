<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ApplicationReceived extends Notification
{
    use Queueable;

    protected $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Application Received - SkillBridge Africa')
            ->line('A student has applied to your internship: ' . $this->application->internship->title)
            ->action('View Application', url(route('internships.applications', $this->application->internship)))
            ->line('Login to your dashboard to review and respond.');
    }
}