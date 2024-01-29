<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KirimAntrian extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $body;
    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        return $this->from('noreply@bpsntb.id','BUKUTAMU')
                    ->subject('[NOREPLY] Nomor Antrian')
                    ->markdown('emails.antrian')->with('body',$this->body);
        //return $this->markdown('emails.KirimAntrian');
    }
}
