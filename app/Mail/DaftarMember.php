<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DaftarMember extends Mailable implements ShouldQueue
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
        //return $this->markdown('emails.daftarmember')->with('body',$this->body);
        return $this->from('noreply@statsntb.id','BUKUTAMU')
                    ->subject('[NOREPLY] Pendaftaran Member Baru')
                    ->markdown('emails.daftarmember')->with('body',$this->body);
    }
}
