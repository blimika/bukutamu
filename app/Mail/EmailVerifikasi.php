<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerifikasi extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $body;

    public function __construct($body)
    {
        //
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->markdown('emails.mailverifikasi');
        return $this->from('noreply@bpsntb.id','BUKUTAMU')
                    ->subject('[NOREPLY] E-mail Verifikasi')
                    ->markdown('emails.mailverifikasi')->with('body',$this->body);
    }
}
