<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ApplicationStatusUpdated extends Notification
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
            ->subject('Application Status Updated - SkillBridge Africa')
            ->line('Your application for ' . $this->application->internship->title . ' has been ' . strtoupper($this->application->status))
            ->action('View Application', url(route('applications.index')))
            ->line('Thank you for using SkillBridge Africa.');
    }
}