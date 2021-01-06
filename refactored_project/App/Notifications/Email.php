<?php

namespace App\Notifications;

use SendGrid;
use SendGrid\Mail\Mail as Mail;

class Email {

    public static function sendEmail( 
        string $username,
        string $subject,
        string $userEmail, 
        string $mailContent
    ): bool {
        $email = new Mail(); 
        $email->setFrom( $_ENV["SENDGRID_SENDER_IDENTITY"], $username );
        $email->setSubject( $subject );
        $email->addTo( $userEmail, $username );
        $email->addContent(
            "text/html", $mailContent
        );
        $sendgrid = new SendGrid( $_ENV["SENDGRD_API_KEY"] );
        try {
            $response = $sendgrid->send($email);
            // TODO log $response->statusCode(), $response->headers() & $response->body() to file
            return true;
        } catch ( \Exception $e ) {
            // TODO log sending email error to file
            echo 'Caught exception: '. $e->getMessage() ."\n";
            return false;
        }
    }

}