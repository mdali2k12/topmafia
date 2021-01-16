<?php

namespace App\Services;

use App\Models\AppToken;
use App\Models\User;

use App\Notifications\Email;

class EmailsService {

    // sending the account verification link email
    public function sendAccountVerificationEmail( User $user ) : void {
        $token  = ( new AppToken() )->create( $user->getId(), "accountverification" );
        $mailContents = "
            <html>
                <body>
                    <h2>Your login details for Top Mafia!</h2>
                    <p>Your username is "
                        ."<strong>".$user->username."</strong>"
                    ."</p>"
                    ."<p>"
                        ."<a href='".$_ENV["APP_URL"]."apptokens?token=".$token."&type=accountverification"."'>Click here to verify email</a>"
                    ."</p>
                </body>
            </html> 
        ";
        Email::sendEmail(
            $_ENV["MAIL_FROM_NAME"] , 
            "Verify your Top Mafia account!", 
            $user->getEmail(),
            $mailContents
        );
    }
    
}