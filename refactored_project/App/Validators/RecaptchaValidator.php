<?php

namespace App\Validators;

use DateTime;
use ReCaptcha\ReCaptcha as ReCaptcha;

trait RecaptchaValidator {

    protected function verifyRecaptchaResponse( string $token ): bool {
        $recaptcha         = new ReCaptcha( $_ENV['GRECAPTCHA_SECRET'] );
        $recaptchaResponse = 
            $recaptcha
                ->setChallengeTimeout( 120 )
                ->setExpectedHostname( $_ENV['CLIENT_HOST_NAME'] )
                ->setScoreThreshold(0.6)
                ->verify( $token );
        if( !$recaptchaResponse->isSuccess() ) {
            $errors = json_encode( $recaptchaResponse->getErrorCodes() );
            error_log(
                ( new DateTime() )->format('Y-m-d H:i:s') . " - Recaptcha : error while verifying recaptcha => " . $errors . "\n",
                3,
                "./logs/app/apis.log"
            );
        }
        return $recaptchaResponse->isSuccess();
    }

} // EO class