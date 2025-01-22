<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewBookNotification extends Notification
{
    use Queueable;

    protected $book;

    public function __construct($book)
    {
        $this->book = $book;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Book Added')
                    ->line('A new book has been added to the library.')
                    ->line('Title: '.$this->book->title)
                    ->action('View Book', url('/'))
                    ->line('Thank you for using our application!');
    }
}
