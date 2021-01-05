<?php

namespace App\Notifications;

use App\Helpers\StringsTrait;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class Email {

    use StringsTrait;

    public PHPMailer $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer( true );
    }

    // TODO test & get template from outside the function to make it more modular ?
    public function sendEmail( $to, $username, $password ) : bool
    {
        try {
            $body = "
                <html>
                    <body>
                        <h2>We've reset your password!</h2>
                        <p>Your username is <strong>".$this->sanitizeStringInput( $username )."</strong></p>
                        <p>Your new password is <strong>".$this->sanitizeStringInput( $password )."</strong>.</p>
                    </body>
                </html>
            ";

            // TODO these email fields should be dynamic
            $this->mailer->AddReplyTo( "webmail@topmafia.net", "Top Mafia" );
            $this->mailer->SetFrom( "webmail@topmafia.net", "Top Mafia" );
            $this->mailer->Subject  = "Your new password for Top Mafia!";

            $this->mailer->AddAddress( $to );
            $this->mailer->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
            $this->mailer->WordWrap = 80; // set word wrap
            $this->mailer->MsgHTML( $body );
            $this->mailer->IsHTML(true); // send as HTML
            $this->mailer->Send();
            return true;
        }
        catch ( PHPMailerException $phpme ) {
            // TODO log to file
        }
    } // EO sendEmail( function

}