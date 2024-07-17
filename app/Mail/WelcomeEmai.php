<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmai extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        //
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $bccAry = [];
        return $this->subject('☆人事管理システム運営事務局からのご連絡☆')
                    ->from($address = 'info@xs017476.xsrv.jp', $name = 'info-support')      
                    ->bcc($bccAry)                         
                    ->view('emails.welcomeMail');
    }
}
