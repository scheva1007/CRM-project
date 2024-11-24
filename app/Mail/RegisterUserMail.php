<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterUserMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $client;
    public $tries = 5;
    public $backoff = [10, 20, 30, 50];

    public function __construct($client)
    {
        $this->client=$client;
    }

    public function build()
    {
        return $this->subject('Добро пожаловать')->view('clients.email.registered');
    }
}
