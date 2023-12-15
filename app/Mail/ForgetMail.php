<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function build()
    {
        $resetLink = 'http://localhost:8000/api/forgetpassword/' . $this->token;

        return $this->from('anita171809@gmail.com')
                    ->view('mail.forget')
                    ->with(['data' => $this->token, 'resetLink' => $resetLink])
                    ->subject('Password Reset Link');
    }
}