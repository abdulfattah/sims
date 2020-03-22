<?php

namespace App\Mail;

use App\Libs\App;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LostPassword extends Mailable
{
    use App;
    use Queueable, SerializesModels;

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
            ->subject('[CDN Information Integration System] Reset Password')
            ->view('email.lost_password')
            ->with([
                'name' => $this->data['name'],
                'url'  => $this->data['url'],
            ]);
    }
}
