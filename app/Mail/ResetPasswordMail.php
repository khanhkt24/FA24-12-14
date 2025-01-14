<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('Đặt lại mật khẩu')
                    ->view('Client.email.resetPassword')
                    ->with([
                        'token' => $this->token,
                        'email' => $this->email,
                        'link' => route('password.reset', ['token' => $this->token, 'email' => $this->email])
                    ]);
    }
}
