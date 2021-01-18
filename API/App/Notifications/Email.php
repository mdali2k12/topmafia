<?php

namespace App\Notifications;

use App\Services\LoggerService;

use SendGrid;
use SendGrid\Mail\Mail as Mail;

class Email {

    public static function sendEmail( 
        string $fromName,
        string $subject,
        string $toEmail, 
        string $emailContents
    ): bool {
        $logger = LoggerService::getInstance();
        $email = new Mail(); 
        $email->setFrom( $_ENV["SENDGRID_SENDER_IDENTITY"], $fromName );
        $email->setSubject( $subject );
        $email->addTo( $toEmail );
        $email->addContent(
            "text/html", $emailContents
        );
        $sendgrid = new SendGrid( $_ENV["SENDGRD_API_KEY"] );
        try {
            $response = $sendgrid->send($email);
            $logger->log( "info", "SendGrid email response status code => ".  $response->statusCode() );
            $logger->log( "info", "SendGrid email response headers => ".  json_encode( $response->headers() ) );
            $logger->log( "info", "SendGrid email response body => ".  json_encode( $response->body() ) );
            return true;
        } catch ( \Exception $e ) {
            $logger->log( "info", "Caught exception: ". $e->getMessage() );
            return false;
        }
    }

}