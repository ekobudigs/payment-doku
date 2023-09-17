<?php

namespace App\Mail\WEB\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Mail data
        $mail['subject'] = __('auth.password_reset.mail.title').' | '.config('app.name');
        $mail['from'] = config('mail.from.address');
        $mail['to'] = $this->data['email'];
        $mail['markdown'] = 'mail.auth.forgot-password';
        $mail['url'] = route('web.auth.forgot-password.index', ['email' => $mail['to'], 'locale' => app()->getLocale()]);

        return $this
            ->subject($mail['subject'])
            ->from($mail['from'])
            ->to($mail['to'])
            ->markdown($mail['markdown'])
            ->with($mail);
    }
}
