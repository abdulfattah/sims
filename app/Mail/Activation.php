<?php

namespace App\Mail;

use App\Libs\App;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Activation extends Mailable
{

    use Queueable, SerializesModels;
    use App;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        $mailFromEmail = $this->getDbConfig('emel_daripada') == null ? 'a.fattah@ymail.com' : $this->getDbConfig('emel_daripada');
        $mailFromName  = $this->getDbConfig('emel_nama') == null ? 'CDN Information Integration System' : $this->getDbConfig('emel_nama');

        return $this->from($mailFromEmail, $mailFromName)
            ->subject('[CDN Information Integration System] Activate Your Account')
            ->view('email.user_activation')
            ->with([
                'name'    => $this->data['name'],
                'url'     => $this->data['url'],
                'expired' => $this->data['expired'],
            ]);
    }
}
