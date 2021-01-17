<?php

namespace App\Validators;

use App\Services\LoggerService;

use DateTime;
use ReCaptcha\ReCaptcha as ReCaptcha;

trait RecaptchaValidator {

    protected function verifyRecaptchaResponse( string $token ): bool {
        $logger            = LoggerService::getInstance();
        $recaptcha         = new ReCaptcha( $_ENV['GRECAPTCHA_SECRET'] );
        $recaptchaResponse = 
            $recaptcha
                ->setChallengeTimeout( 120 )
                ->setExpectedHostname( $_ENV['CLIENT_HOST_NAME'] )
                ->setScoreThreshold(0.6)
                ->verify( $token );
        if( !$recaptchaResponse->isSuccess() ) {
            $errors = json_encode( $recaptchaResponse->getErrorCodes() );
            $logger->log( 
               "info", 
               "Recaptcha => ".( new DateTime() )->format('Y-m-d H:i:s') . " - Recaptcha : error while verifying recaptcha => " . $errors . "\n" 
            );
        }
        return $recaptchaResponse->isSuccess();
    }

} // EO class